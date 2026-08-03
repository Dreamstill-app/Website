<?php

namespace App\Services\Sorting;

use App\Models\DamageMarker;
use App\Models\Sort;
use App\Services\Ai\AzureOpenAi;
use App\Services\Media\ImageStorage;

/**
 * Orchestrates a sort analysis (docs/ARCHITECTURE.md §2.1):
 *   1. Azure vision proposes damages / category / brand (optional layer)
 *   2. DecisionTree makes the authoritative, explainable call
 *   3. PriceEstimator attaches a resale band; $-threshold may reroute decision
 *
 * Falls back to rules-only on user markers when vision is unavailable.
 */
class AnalysisEngine
{
    public function __construct(
        private readonly AzureOpenAi $ai,
        private readonly DecisionTree $tree,
        private readonly PriceEstimator $prices,
    ) {}

    /**
     * Analyze the sort in place: populates decision fields, persists markers
     * from vision, and returns the updated model.
     */
    public function analyze(Sort $sort): Sort
    {
        $sort->loadMissing(['images', 'damageMarkers', 'surveyResponse']);

        // --- Layer 1: vision proposal -----------------------------------
        $vision = $this->runVision($sort);
        $source = $vision !== null ? 'vision-llm' : 'rules-only';

        // --- Merge damages: user markers + vision detections -------------
        $damages = $this->mergeDamages($sort, $vision);

        // --- Layer 2: decision tree --------------------------------------
        $survey = $sort->surveyResponse;
        $context = [
            'brand' => $sort->brand ?: ($vision['brand'] ?? null),
            'thrifted' => $survey?->thrifted,
            'style' => $survey?->style,
        ];

        $result = $this->tree->decide($damages, $context, $vision['quality_signals'] ?? []);
        $reasons = $result['reasons'];

        // --- Layer 3: price band -----------------------------------------
        $category = $sort->category ?: ($vision['category'] ?? null);
        $brand = $context['brand'];
        $band = $this->prices->band($brand, $category, $result['condition_score']);

        $decision = $this->tree->applyPriceThreshold(
            $result['decision'],
            $band['high'] ?? null,
            $reasons
        );

        // --- Persist ------------------------------------------------------
        $sort->fill([
            'status' => Sort::STATUS_ANALYZED,
            'decision' => $decision,
            'condition_score' => $result['condition_score'],
            'price_low' => $decision === 'resell' ? ($band['low'] ?? null) : null,
            'price_high' => $decision === 'resell' ? ($band['high'] ?? null) : null,
            'brand' => $brand,
            'category' => $category,
            'analysis' => [
                'reasons' => $reasons,
                'damages' => $damages,
                'colours' => $vision['colours'] ?? [],
                'quality_signals' => $vision['quality_signals'] ?? [],
                'vision_raw' => $vision,
            ],
            'analysis_source' => $source,
            'tree_version' => (string) config('sorty.tree_version'),
            'model_version' => $vision !== null ? AzureOpenAi::PROMPT_VERSION : null,
            'analyzed_at' => now(),
        ]);
        $sort->save();

        $this->persistVisionMarkers($sort, $vision);

        return $sort;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function runVision(Sort $sort): ?array
    {
        $storage = app(ImageStorage::class);
        $bytes = [];

        foreach (['front', 'back', 'tag'] as $type) {
            $image = $sort->image($type);
            if ($image !== null) {
                $contents = $storage->readBytes($image->path);
                if ($contents !== null) {
                    $bytes[$type] = $contents;
                }
            }
        }

        if ($bytes === []) {
            return null;
        }

        return $this->ai->analyzeGarment($bytes);
    }

    /**
     * Union of user markers and vision detections, deduplicated by damage type
     * (user severity wins on conflict — the human saw it in person).
     *
     * @param  array<string, mixed>|null  $vision
     * @return array<int, array{type: string, severity: int|null, source: string, size_over_threshold: bool}>
     */
    private function mergeDamages(Sort $sort, ?array $vision): array
    {
        $damages = [];

        foreach ($sort->damageMarkers->where('source', 'user') as $marker) {
            $damages[] = [
                'type' => $marker->damage_type,
                'severity' => $marker->severity,
                'source' => 'user',
                'size_over_threshold' => false,
            ];
        }

        $userTypes = array_column($damages, 'type');

        foreach ($vision['damages'] ?? [] as $detection) {
            if (! in_array($detection['type'] ?? '', DamageMarker::TYPES, true)) {
                continue;
            }

            if (in_array($detection['type'], $userTypes, true)) {
                // Same type already marked by user; only inherit oversized flag.
                foreach ($damages as &$damage) {
                    if ($damage['type'] === $detection['type'] && ($detection['size_over_threshold'] ?? false)) {
                        $damage['size_over_threshold'] = true;
                    }
                }
                unset($damage);

                continue;
            }

            $damages[] = [
                'type' => $detection['type'],
                'severity' => (int) ($detection['severity'] ?? 1),
                'source' => 'vision',
                'size_over_threshold' => (bool) ($detection['size_over_threshold'] ?? false),
                'location' => $detection['location'] ?? null,
                'image' => $detection['image'] ?? 'front',
            ];
        }

        return $damages;
    }

    /**
     * Store vision-only detections as markers (training labels for Phase 9).
     *
     * @param  array<string, mixed>|null  $vision
     */
    private function persistVisionMarkers(Sort $sort, ?array $vision): void
    {
        if ($vision === null) {
            return;
        }

        $sort->damageMarkers()->where('source', 'vision')->delete();

        foreach ($vision['damages'] ?? [] as $detection) {
            if (! in_array($detection['type'] ?? '', DamageMarker::TYPES, true)) {
                continue;
            }

            $sort->damageMarkers()->create([
                'image_type' => in_array($detection['image'] ?? 'front', ['front', 'back'], true) ? $detection['image'] : 'front',
                'damage_type' => $detection['type'],
                'severity' => min(3, max(1, (int) ($detection['severity'] ?? 1))),
                // Vision detections carry a text location, not coordinates (yet).
                'x' => 0.5,
                'y' => 0.5,
                'source' => 'vision',
            ]);
        }
    }
}

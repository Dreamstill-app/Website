<?php

namespace App\Services\Sorting;

use App\Models\DamageMarker;

/**
 * Deterministic garment decision engine.
 *
 * Implements docs/decision-tree.md v1.0 exactly. The vision model proposes
 * damages; this engine makes the final, explainable call. Any behavioural
 * change requires a spec update + version bump (config sorty.tree_version).
 */
class DecisionTree
{
    /**
     * @param  array<int, array{type: string, severity?: int|null, source?: string, size_over_threshold?: bool}>  $damages
     *                                                                                                                      Deduplicated damages from user markers + vision detections.
     * @param  array{brand?: ?string, thrifted?: ?bool, style?: ?string}  $context
     * @param  array<int, string>  $qualitySignals  Vision-model quality flags (e.g. "heavy wear").
     * @return array{condition_score: int, decision: string, reasons: array<int, string>}
     */
    public function decide(array $damages, array $context = [], array $qualitySignals = []): array
    {
        $reasons = [];

        [$classA, $classB] = $this->partition($damages);

        $score = $this->score($classA, $classB, $reasons);

        // Vision quality signals may downgrade one step, never upgrade (spec §Scoring 5).
        if ($score > 1 && $this->hasDowngradeSignal($qualitySignals)) {
            $score--;
            $reasons[] = 'Overall wear detected in photo analysis';
        }

        $decision = $this->mapDecision($score, $classA, $classB, $context, $reasons);

        return [
            'condition_score' => $score,
            'decision' => $decision,
            'reasons' => $reasons,
        ];
    }

    /**
     * Split damages into class A (not repairable) and class B (repairable),
     * promoting oversized class-B damage to class-A severe (spec §Scoring 3).
     *
     * @return array{0: array<int, array<string, mixed>>, 1: array<int, array<string, mixed>>}
     */
    private function partition(array $damages): array
    {
        $classA = [];
        $classB = [];

        $tearCount = collect($damages)->where('type', 'tear')->count();

        foreach ($damages as $damage) {
            $type = $damage['type'];

            if (in_array($type, DamageMarker::CLASS_B, true)) {
                $oversized = ($damage['size_over_threshold'] ?? false)
                    || ($type === 'tear' && $tearCount > 2);

                if ($oversized) {
                    // Beyond repair economics → treat as class A severe.
                    $classA[] = ['type' => $type, 'severity' => 3] + $damage;
                } else {
                    $classB[] = $damage;
                }

                continue;
            }

            $classA[] = $damage + ['severity' => $damage['severity'] ?? 1];
        }

        return [$classA, $classB];
    }

    /**
     * @param  array<int, array<string, mixed>>  $classA
     * @param  array<int, array<string, mixed>>  $classB
     * @param  array<int, string>  $reasons
     */
    private function score(array $classA, array $classB, array &$reasons): int
    {
        if ($classA === [] && $classB === []) {
            $reasons[] = 'No damage detected — excellent condition';

            return 4;
        }

        if ($classA === []) {
            $reasons[] = $this->describeClassB($classB).' — repairable';

            return 2;
        }

        $severities = array_map(fn (array $d) => (int) ($d['severity'] ?? 1), $classA);
        $maxSeverity = max($severities);
        $distinctTypes = count(array_unique(array_map(fn (array $d) => $d['type'], $classA)));

        if ($maxSeverity >= 3 || $distinctTypes >= 3) {
            $reasons[] = $this->describeClassA($classA).' — significant damage';

            return 1;
        }

        if ($maxSeverity === 2) {
            if ($classB !== []) {
                $reasons[] = $this->describeClassA($classA).' with '.$this->describeClassB($classB);

                return 2;
            }

            if (count($classA) === 1 && in_array($classA[0]['type'], ['pilling', 'faded_colour'], true)) {
                $reasons[] = $this->describeClassA($classA).' — cosmetic, still wearable';

                return 3;
            }

            $reasons[] = $this->describeClassA($classA).' — moderate damage';

            return 2;
        }

        $reasons[] = $this->describeClassA($classA).' — minor damage';

        return 3;
    }

    /**
     * @param  array<int, array<string, mixed>>  $classA
     * @param  array<int, array<string, mixed>>  $classB
     * @param  array{brand?: ?string, thrifted?: ?bool, style?: ?string}  $context
     * @param  array<int, string>  $reasons
     */
    private function mapDecision(int $score, array $classA, array $classB, array $context, array &$reasons): string
    {
        $decision = match ($score) {
            4 => 'resell',
            3 => 'donate',
            2 => 'repair',
            default => 'recycle',
        };

        // Score 2 without repairable defects → Donate (spec §Decision mapping).
        if ($decision === 'repair' && $classB === []) {
            $decision = 'donate';
            $reasons[] = 'No repairable defects — better suited to donation';
        }

        // Luxury brand at score 3 → consignment resell (spec §Decision mapping).
        if ($decision === 'donate' && $score === 3 && ($context['style'] ?? null) === 'luxury') {
            $decision = 'resell';
            $reasons[] = 'Luxury item — consignment recommended over donation';
        }

        if ($decision === 'recycle') {
            $reasons[] = 'Recycling keeps the materials in use — please do not donate damaged items';
        }

        return $decision;
    }

    /**
     * Applied AFTER price estimation by the AnalysisEngine: resell items whose
     * estimated value is below the threshold route to donate (capstone $20 rule).
     *
     * @param  array<int, string>  $reasons
     */
    public function applyPriceThreshold(string $decision, ?int $priceHigh, array &$reasons): string
    {
        $threshold = (int) config('sorty.resell_price_threshold');

        if ($decision === 'resell' && $priceHigh !== null && $priceHigh < $threshold) {
            $reasons[] = "Estimated value under \${$threshold} — donating creates more impact than reselling";

            return 'donate';
        }

        return $decision;
    }

    /** @param array<int, array<string, mixed>> $damages */
    private function describeClassA(array $damages): string
    {
        return $this->describe($damages);
    }

    /** @param array<int, array<string, mixed>> $damages */
    private function describeClassB(array $damages): string
    {
        return $this->describe($damages);
    }

    /** @param array<int, array<string, mixed>> $damages */
    private function describe(array $damages): string
    {
        $labels = [
            'stain' => 'stain',
            'damaged_text' => 'damaged print',
            'shrinkage' => 'shrinkage',
            'faded_colour' => 'faded colour',
            'pilling' => 'pilling',
            'tear' => 'tear',
            'seam_breakage' => 'seam breakage',
            'missing_button' => 'missing button',
            'broken_zipper' => 'broken zipper',
        ];

        $counts = [];
        foreach ($damages as $damage) {
            $label = $labels[$damage['type']] ?? $damage['type'];
            $counts[$label] = ($counts[$label] ?? 0) + 1;
        }

        $parts = [];
        foreach ($counts as $label => $count) {
            $parts[] = $count > 1 ? "{$count} {$label}s" : "1 {$label}";
        }

        return ucfirst(implode(', ', $parts));
    }

    private function hasDowngradeSignal(array $qualitySignals): bool
    {
        $downgrades = ['heavy wear', 'heavily worn', 'misshapen', 'stretched', 'discoloured overall', 'discolored overall'];

        foreach ($qualitySignals as $signal) {
            foreach ($downgrades as $needle) {
                if (str_contains(mb_strtolower($signal), $needle)) {
                    return true;
                }
            }
        }

        return false;
    }
}

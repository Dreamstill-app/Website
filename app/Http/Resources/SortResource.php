<?php

namespace App\Http\Resources;

use App\Models\Sort;
use App\Services\Media\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Sort */
class SortResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $analysis = $this->analysis ?? [];

        $storage = app(ImageStorage::class);

        $images = [];
        foreach ($this->whenLoaded('images', fn () => $this->images, collect()) as $image) {
            if (in_array($image->type, ['front', 'back', 'tag'], true)) {
                // CDN URL when on Azure; authorized API route on local disk.
                $images[$image->type] = $storage->publicUrl($image->path)
                    ?? url("/api/v1/sorts/{$this->id}/images/{$image->type}");
            }
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'decision' => $this->decision,
            'condition_score' => $this->condition_score,
            'reasons' => $analysis['reasons'] ?? [],
            'damages' => collect($analysis['damages'] ?? [])->map(fn (array $damage) => [
                'type' => $damage['type'],
                'severity' => $damage['severity'] ?? null,
                'source' => $damage['source'] ?? 'user',
                'location' => $damage['location'] ?? null,
            ])->values(),
            'price_estimate' => $this->price_low !== null ? [
                'low' => $this->price_low,
                'high' => $this->price_high,
                'currency' => 'CAD',
            ] : null,
            'brand' => $this->brand,
            'category' => $this->category,
            'colours' => $analysis['colours'] ?? [],
            'images' => $images,
            'corrected_decision' => $this->corrected_decision,
            'engine' => [
                'tree_version' => $this->tree_version,
                'analysis_source' => $this->analysis_source,
            ],
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}

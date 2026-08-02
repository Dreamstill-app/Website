<?php

namespace App\Services\Sorting;

use App\Models\BrandTier;

/**
 * Brand-tier price band estimator (docs/decision-tree.md §Price estimation).
 * Only scores 3–4 receive a resale estimate.
 */
class PriceEstimator
{
    /**
     * @return array{low: int, high: int, currency: string}|null
     */
    public function band(?string $brand, ?string $category, int $conditionScore): ?array
    {
        $config = config('sorty.price');

        $conditionMultiplier = $config['condition_multiplier'][$conditionScore] ?? null;

        if ($conditionMultiplier === null) {
            return null;
        }

        $base = $config['category_base'][$category ?? 'other'] ?? $config['category_base']['other'];
        $tier = BrandTier::tierFor($brand);
        $tierMultiplier = $config['tier_multiplier'][$tier] ?? $config['tier_multiplier']['unknown'];

        $estimate = $base * $tierMultiplier * $conditionMultiplier;

        return [
            'low' => max(1, (int) round($estimate * $config['band_low'])),
            'high' => max(2, (int) round($estimate * $config['band_high'])),
            'currency' => 'CAD',
        ];
    }
}

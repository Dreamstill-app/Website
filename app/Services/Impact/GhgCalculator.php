<?php

namespace App\Services\Impact;

use App\Models\ImpactMetric;
use App\Models\Sort;
use Illuminate\Support\Facades\DB;

/**
 * Impact rollups: sorts → GHG avoided + textiles diverted.
 * Factors in config/sorty.php (ported from the Dreamstill GHG Calculator).
 */
class GhgCalculator
{
    /**
     * Compute impact figures for a set of decision counts.
     *
     * @param  array<string, int>  $byDecision
     * @return array{ghg_kg_avoided: float, textiles_kg_diverted: float}
     */
    public function fromDecisionCounts(array $byDecision): array
    {
        $garmentKg = (float) config('sorty.impact.avg_garment_kg');
        $factors = config('sorty.impact.ghg_per_kg');

        $ghg = 0.0;
        $kg = 0.0;

        foreach ($byDecision as $decision => $count) {
            $factor = $factors[$decision] ?? 0.0;
            $ghg += $count * $garmentKg * $factor;
            $kg += $count * $garmentKg;
        }

        return [
            'ghg_kg_avoided' => round($ghg, 3),
            'textiles_kg_diverted' => round($kg, 3),
        ];
    }

    /**
     * Roll up metrics for one user (or the whole platform when null).
     */
    public function rollup(?int $userId): ImpactMetric
    {
        $query = Sort::query()
            ->whereNotNull('decision')
            ->whereIn('status', [Sort::STATUS_ANALYZED, Sort::STATUS_ACCEPTED]);

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        /** @var array<string, int> $byDecision */
        $byDecision = $query
            ->select('decision', DB::raw('COUNT(*) as total'))
            ->groupBy('decision')
            ->pluck('total', 'decision')
            ->all();

        $impact = $this->fromDecisionCounts($byDecision);

        return ImpactMetric::query()->updateOrCreate(
            ['user_id' => $userId, 'period' => 'all_time'],
            [
                'sorts_total' => array_sum($byDecision),
                'by_decision' => $byDecision,
                'ghg_kg_avoided' => $impact['ghg_kg_avoided'],
                'textiles_kg_diverted' => $impact['textiles_kg_diverted'],
                'computed_at' => now(),
            ]
        );
    }
}

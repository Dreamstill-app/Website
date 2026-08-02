<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ImpactMetric;
use App\Services\Impact\GhgCalculator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function me(Request $request, GhgCalculator $calculator): JsonResponse
    {
        // Personal impact is cheap to compute — always fresh.
        $metric = $calculator->rollup($request->user()->id);

        return $this->respond($metric);
    }

    public function global(GhgCalculator $calculator): JsonResponse
    {
        $metric = ImpactMetric::query()
            ->whereNull('user_id')
            ->where('period', 'all_time')
            ->first();

        // Recompute lazily when stale (>1h) or missing; nightly job keeps it warm.
        if ($metric === null || $metric->computed_at === null || $metric->computed_at->lt(now()->subHour())) {
            $metric = $calculator->rollup(null);
        }

        return $this->respond($metric);
    }

    private function respond(ImpactMetric $metric): JsonResponse
    {
        return response()->json([
            'data' => [
                'sorts_total' => $metric->sorts_total,
                'by_decision' => $metric->by_decision ?? [],
                'ghg_kg_avoided' => $metric->ghg_kg_avoided,
                'textiles_kg_diverted' => $metric->textiles_kg_diverted,
                'period' => $metric->period,
            ],
        ]);
    }
}

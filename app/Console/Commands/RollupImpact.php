<?php

namespace App\Console\Commands;

use App\Services\Impact\GhgCalculator;
use Illuminate\Console\Command;

class RollupImpact extends Command
{
    protected $signature = 'sorty:rollup-impact';

    protected $description = 'Recompute the platform-wide impact rollup (nightly)';

    public function handle(GhgCalculator $calculator): int
    {
        $metric = $calculator->rollup(null);

        $this->info(sprintf(
            'Global impact: %d sorts, %.1f kg diverted, %.1f kg CO2e avoided',
            $metric->sorts_total,
            $metric->textiles_kg_diverted,
            $metric->ghg_kg_avoided,
        ));

        return self::SUCCESS;
    }
}

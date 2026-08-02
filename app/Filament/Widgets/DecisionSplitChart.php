<?php

namespace App\Filament\Widgets;

use App\Models\Sort;
use Filament\Widgets\ChartWidget;

class DecisionSplitChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Decision split';

    protected ?string $description = 'Where garments are routed';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $byDecision = Sort::query()
            ->whereNotNull('decision')
            ->selectRaw('decision, COUNT(*) as total')
            ->groupBy('decision')
            ->pluck('total', 'decision');

        $order = ['resell', 'donate', 'repair', 'recycle'];
        $colors = [
            'resell' => '#22c55e',
            'donate' => '#3b82f6',
            'repair' => '#f59e0b',
            'recycle' => '#94a3b8',
        ];

        return [
            'labels' => array_map('ucfirst', $order),
            'datasets' => [[
                'data' => array_map(fn (string $d) => (int) ($byDecision[$d] ?? 0), $order),
                'backgroundColor' => array_values($colors),
                'borderWidth' => 0,
            ]],
        ];
    }
}

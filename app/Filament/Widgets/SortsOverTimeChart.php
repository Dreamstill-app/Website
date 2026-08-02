<?php

namespace App\Filament\Widgets;

use App\Models\Sort;
use Filament\Widgets\ChartWidget;

class SortsOverTimeChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Sorting activity';

    protected ?string $description = 'Garments sorted per day — last 30 days';

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $start = now()->subDays(29)->startOfDay();

        $daily = Sort::query()
            ->where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $labels = [];
        $values = [];

        for ($date = $start->copy(); $date->lte(now()); $date->addDay()) {
            $key = $date->toDateString();
            $labels[] = $date->format('M j');
            $values[] = (int) ($daily[$key] ?? 0);
        }

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Sorts',
                'data' => $values,
                'fill' => 'start',
                'tension' => 0.35,
                'borderColor' => '#22c55e',
                'backgroundColor' => 'rgba(34, 197, 94, 0.12)',
                'pointRadius' => 2,
            ]],
        ];
    }
}

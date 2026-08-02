<?php

namespace App\Filament\Widgets;

use App\Models\CommunityTip;
use App\Models\Event;
use App\Models\Sort;
use App\Models\User;
use App\Services\Impact\GhgCalculator;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ImpactStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $byDecision = Sort::query()
            ->whereNotNull('decision')
            ->selectRaw('decision, COUNT(*) as total')
            ->groupBy('decision')
            ->pluck('total', 'decision')
            ->all();

        $impact = app(GhgCalculator::class)->fromDecisionCounts($byDecision);

        $pendingReviews = Event::query()->where('status', 'pending')->count()
            + CommunityTip::query()->where('status', 'pending')->count();

        return [
            Stat::make('Garments sorted', number_format(array_sum($byDecision)))
                ->description('AI-assessed items')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('success'),
            Stat::make('Textiles diverted', number_format($impact['textiles_kg_diverted'], 1).' kg')
                ->description('Kept out of landfill')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),
            Stat::make('GHG avoided', number_format($impact['ghg_kg_avoided'], 1).' kg CO₂e')
                ->description('Emissions saved through circularity')
                ->descriptionIcon('heroicon-m-globe-americas')
                ->color('success'),
            Stat::make('Community', number_format(User::query()->where('is_guest', false)->count()))
                ->description(User::query()->where('is_guest', true)->count().' guests exploring')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
            Stat::make('Pending reviews', number_format($pendingReviews))
                ->description('Events + tips awaiting moderation')
                ->descriptionIcon('heroicon-m-inbox')
                ->color($pendingReviews > 0 ? 'danger' : 'gray'),
        ];
    }
}

<?php

namespace App\Filament\Resources\Sorts\Tables;

use App\Models\Sort;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SortsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('When')
                    ->dateTime('M j, g:i A')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('decision')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'resell' => 'success',
                        'donate' => 'info',
                        'repair' => 'warning',
                        'recycle' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('condition_score')
                    ->label('Score')
                    ->formatStateUsing(fn (?int $state): string => $state ? "{$state}/4" : '—')
                    ->sortable(),
                TextColumn::make('brand')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('category')
                    ->placeholder('—'),
                TextColumn::make('price_high')
                    ->label('Est. value')
                    ->formatStateUsing(fn (?int $state, Sort $record): string => $state ? "\${$record->price_low}–\${$state}" : '—'),
                TextColumn::make('analysis_source')
                    ->label('Engine')
                    ->badge()
                    ->color(fn (?string $state): string => $state === 'vision-llm' ? 'success' : 'gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('corrected_decision')
                    ->label('User correction')
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('decision')
                    ->options(array_combine(Sort::DECISIONS, array_map('ucfirst', Sort::DECISIONS))),
                SelectFilter::make('analysis_source')
                    ->label('Engine')
                    ->options([
                        'vision-llm' => 'Vision AI',
                        'rules-only' => 'Rules only',
                        'custom-model' => 'Custom model',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'analyzed' => 'Analyzed',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                Action::make('exportDataset')
                    ->label('Export dataset (CSV)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn (): StreamedResponse => static::exportCsv()),
            ]);
    }

    /**
     * ML dataset export: pseudonymized (sort UUID only, no user identifiers).
     */
    private static function exportCsv(): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'sort_id', 'created_at', 'decision', 'corrected_decision', 'condition_score',
                'brand', 'category', 'analysis_source', 'tree_version', 'status',
                'damage_types', 'damage_count', 'price_low', 'price_high',
            ]);

            Sort::query()
                ->whereNotNull('decision')
                ->with('damageMarkers')
                ->orderBy('created_at')
                ->chunk(500, function ($sorts) use ($handle): void {
                    foreach ($sorts as $sort) {
                        fputcsv($handle, [
                            $sort->id,
                            $sort->created_at?->toIso8601String(),
                            $sort->decision,
                            $sort->corrected_decision,
                            $sort->condition_score,
                            $sort->brand,
                            $sort->category,
                            $sort->analysis_source,
                            $sort->tree_version,
                            $sort->status,
                            $sort->damageMarkers->pluck('damage_type')->unique()->implode('|'),
                            $sort->damageMarkers->count(),
                            $sort->price_low,
                            $sort->price_high,
                        ]);
                    }
                });

            fclose($handle);
        }, 'sorty-dataset-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv']);
    }
}

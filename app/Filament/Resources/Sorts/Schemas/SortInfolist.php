<?php

namespace App\Filament\Resources\Sorts\Schemas;

use App\Models\Sort;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SortInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Garment photos')
                    ->schema([
                        Grid::make(3)->schema([
                            ImageEntry::make('photo_front')
                                ->label('Front')
                                ->state(fn (Sort $record): ?string => static::imageUrl($record, 'front'))
                                ->placeholder('No photo')
                                ->height(220),
                            ImageEntry::make('photo_back')
                                ->label('Back')
                                ->state(fn (Sort $record): ?string => static::imageUrl($record, 'back'))
                                ->placeholder('No photo')
                                ->height(220),
                            ImageEntry::make('photo_tag')
                                ->label('Brand tag')
                                ->state(fn (Sort $record): ?string => static::imageUrl($record, 'tag'))
                                ->placeholder('No photo')
                                ->height(220),
                        ]),
                    ]),

                Section::make('AI recommendation')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('decision')
                                ->badge()
                                ->color(fn (?string $state): string => match ($state) {
                                    'resell' => 'success',
                                    'donate' => 'info',
                                    'repair' => 'warning',
                                    'recycle' => 'gray',
                                    default => 'gray',
                                })
                                ->placeholder('—'),
                            TextEntry::make('condition_score')
                                ->label('Condition')
                                ->formatStateUsing(fn (?int $state): string => $state ? "{$state} / 4" : '—'),
                            TextEntry::make('price_range')
                                ->label('Est. resale value')
                                ->state(fn (Sort $record): string => $record->price_low
                                    ? "\${$record->price_low}–\${$record->price_high} CAD"
                                    : '—'),
                            TextEntry::make('status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'accepted' => 'success',
                                    'rejected' => 'danger',
                                    default => 'gray',
                                }),
                        ]),
                        TextEntry::make('analysis.reasons')
                            ->label('Why')
                            ->listWithLineBreaks()
                            ->bulleted()
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('damage_summary')
                            ->label('Damage detected')
                            ->state(function (Sort $record): string {
                                $damages = collect($record->analysis['damages'] ?? []);

                                if ($damages->isEmpty()) {
                                    return 'None';
                                }

                                return $damages->map(function (array $d): string {
                                    $parts = [ucfirst(str_replace('_', ' ', $d['type'] ?? 'unknown'))];
                                    if (isset($d['severity'])) {
                                        $parts[] = "severity {$d['severity']}/3";
                                    }
                                    if (! empty($d['location'])) {
                                        $parts[] = $d['location'];
                                    }
                                    $parts[] = ($d['source'] ?? 'user') === 'vision' ? 'found by AI' : 'marked by user';

                                    return implode(' · ', $parts);
                                })->implode("\n");
                            })
                            ->columnSpanFull(),
                    ]),

                Section::make('Garment details')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('brand')->placeholder('—'),
                            TextEntry::make('category')->placeholder('—'),
                            TextEntry::make('colours')
                                ->state(fn (Sort $record): string => implode(', ', $record->analysis['colours'] ?? []) ?: '—'),
                            TextEntry::make('user.name')->label('Sorted by'),
                        ]),
                    ]),

                Section::make('User feedback (training labels)')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('corrected_decision')
                                ->label('User correction')
                                ->badge()
                                ->color('warning')
                                ->placeholder('None'),
                            TextEntry::make('accepted_at')
                                ->dateTime()
                                ->placeholder('—'),
                            TextEntry::make('feedback')
                                ->placeholder('—'),
                        ]),
                    ])
                    ->collapsed(),

                Section::make('Engine metadata')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('analysis_source')
                                ->label('Engine')
                                ->badge()
                                ->color(fn (?string $state): string => $state === 'vision-llm' ? 'success' : 'gray'),
                            TextEntry::make('tree_version')->label('Decision tree')->placeholder('—'),
                            TextEntry::make('model_version')->label('Model/prompt')->placeholder('—'),
                            TextEntry::make('analyzed_at')->dateTime()->placeholder('—'),
                        ]),
                    ])
                    ->collapsed(),
            ]);
    }

    private static function imageUrl(Sort $record, string $type): ?string
    {
        return $record->images->firstWhere('type', $type)
            ? route('admin.sort-image', ['sort' => $record->id, 'type' => $type])
            : null;
    }
}

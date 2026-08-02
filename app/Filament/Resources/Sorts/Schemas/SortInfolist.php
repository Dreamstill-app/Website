<?php

namespace App\Filament\Resources\Sorts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SortInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('status'),
                TextEntry::make('decision')
                    ->placeholder('-'),
                TextEntry::make('condition_score')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('price_low')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('price_high')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('brand')
                    ->placeholder('-'),
                TextEntry::make('category')
                    ->placeholder('-'),
                TextEntry::make('analysis')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('analysis_source')
                    ->placeholder('-'),
                TextEntry::make('tree_version')
                    ->placeholder('-'),
                TextEntry::make('model_version')
                    ->placeholder('-'),
                TextEntry::make('corrected_decision')
                    ->placeholder('-'),
                TextEntry::make('feedback')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('accepted_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('analyzed_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

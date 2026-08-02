<?php

namespace App\Filament\Resources\Challenges\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ChallengeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('points')
                    ->required()
                    ->numeric()
                    ->default(10),
                TextInput::make('metric')
                    ->required()
                    ->default('sorts_count'),
                TextInput::make('target')
                    ->required()
                    ->numeric()
                    ->default(1),
                DateTimePicker::make('starts_at'),
                DateTimePicker::make('ends_at'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}

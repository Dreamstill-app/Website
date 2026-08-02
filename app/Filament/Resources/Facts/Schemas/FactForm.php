<?php

namespace App\Filament\Resources\Facts\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('text')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('category')
                    ->default(null),
                TextInput::make('source')
                    ->default(null),
                TextInput::make('source_url')
                    ->url()
                    ->default(null),
                TextInput::make('year')
                    ->numeric()
                    ->default(null),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}

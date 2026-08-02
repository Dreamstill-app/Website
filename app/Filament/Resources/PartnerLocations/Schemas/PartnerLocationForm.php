<?php

namespace App\Filament\Resources\PartnerLocations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PartnerLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('lat')
                    ->required()
                    ->numeric(),
                TextInput::make('lng')
                    ->required()
                    ->numeric(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('city')
                    ->required()
                    ->default('Vancouver'),
                Textarea::make('hours')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('accepted_categories')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('website')
                    ->url()
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('partner_user_id')
                    ->relationship('partnerUser', 'name')
                    ->default(null),
                DateTimePicker::make('verified_at'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}

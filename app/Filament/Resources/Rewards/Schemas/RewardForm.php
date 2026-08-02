<?php

namespace App\Filament\Resources\Rewards\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RewardForm
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
                TextInput::make('points_cost')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('reward_type')
                    ->required()
                    ->default('discount_code'),
                TextInput::make('partner_name')
                    ->default(null),
                FileUpload::make('image_path')
                    ->image(),
                TextInput::make('stock')
                    ->numeric()
                    ->default(null),
                DateTimePicker::make('expires_at'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}

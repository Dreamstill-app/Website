<?php

namespace App\Filament\Resources\CommunityTips\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommunityTipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Textarea::make('text')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->image(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('moderation_reason')
                    ->default(null),
                TextInput::make('moderation_source')
                    ->default(null),
            ]);
    }
}

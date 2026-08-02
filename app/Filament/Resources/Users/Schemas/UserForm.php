<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('role')
                    ->required()
                    ->default('user'),
                Toggle::make('is_guest')
                    ->required(),
                TextInput::make('avatar_path')
                    ->default(null),
                TextInput::make('city')
                    ->default(null),
                TextInput::make('postal_prefix')
                    ->default(null),
                Textarea::make('preferences')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('total_points')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('account_type')
                    ->required()
                    ->default('personal'),
                Textarea::make('social_links')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('occupation')
                    ->default(null),
            ]);
    }
}

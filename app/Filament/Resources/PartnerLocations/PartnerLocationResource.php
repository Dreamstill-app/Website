<?php

namespace App\Filament\Resources\PartnerLocations;

use App\Filament\Resources\PartnerLocations\Pages\CreatePartnerLocation;
use App\Filament\Resources\PartnerLocations\Pages\EditPartnerLocation;
use App\Filament\Resources\PartnerLocations\Pages\ListPartnerLocations;
use App\Filament\Resources\PartnerLocations\Schemas\PartnerLocationForm;
use App\Filament\Resources\PartnerLocations\Tables\PartnerLocationsTable;
use App\Models\PartnerLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerLocationResource extends Resource
{
    protected static ?string $model = PartnerLocation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PartnerLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnerLocationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPartnerLocations::route('/'),
            'create' => CreatePartnerLocation::route('/create'),
            'edit' => EditPartnerLocation::route('/{record}/edit'),
        ];
    }
}

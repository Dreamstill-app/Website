<?php

namespace App\Filament\Resources\Sorts;

use App\Filament\Resources\Sorts\Pages\ListSorts;
use App\Filament\Resources\Sorts\Pages\ViewSort;
use App\Filament\Resources\Sorts\Schemas\SortInfolist;
use App\Filament\Resources\Sorts\Tables\SortsTable;
use App\Models\Sort;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

/**
 * Read-only browser of user sorts — the platform's dataset.
 * Records are created by the app; admins observe, filter, and export.
 */
class SortResource extends Resource
{
    protected static ?string $model = Sort::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Sorts (AI dataset)';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function infolist(Schema $schema): Schema
    {
        return SortInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SortsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSorts::route('/'),
            'view' => ViewSort::route('/{record}'),
        ];
    }
}

<?php

namespace App\Filament\Resources\CommunityTips;

use App\Filament\Resources\CommunityTips\Pages\CreateCommunityTip;
use App\Filament\Resources\CommunityTips\Pages\EditCommunityTip;
use App\Filament\Resources\CommunityTips\Pages\ListCommunityTips;
use App\Filament\Resources\CommunityTips\Schemas\CommunityTipForm;
use App\Filament\Resources\CommunityTips\Tables\CommunityTipsTable;
use App\Models\CommunityTip;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CommunityTipResource extends Resource
{
    protected static ?string $model = CommunityTip::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CommunityTipForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunityTipsTable::configure($table);
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
            'index' => ListCommunityTips::route('/'),
            'create' => CreateCommunityTip::route('/create'),
            'edit' => EditCommunityTip::route('/{record}/edit'),
        ];
    }
}

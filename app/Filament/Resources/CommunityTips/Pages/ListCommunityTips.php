<?php

namespace App\Filament\Resources\CommunityTips\Pages;

use App\Filament\Resources\CommunityTips\CommunityTipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCommunityTips extends ListRecords
{
    protected static string $resource = CommunityTipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

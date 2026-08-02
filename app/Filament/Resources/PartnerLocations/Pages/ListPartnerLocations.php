<?php

namespace App\Filament\Resources\PartnerLocations\Pages;

use App\Filament\Resources\PartnerLocations\PartnerLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartnerLocations extends ListRecords
{
    protected static string $resource = PartnerLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

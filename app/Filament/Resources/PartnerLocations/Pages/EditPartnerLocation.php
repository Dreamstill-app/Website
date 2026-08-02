<?php

namespace App\Filament\Resources\PartnerLocations\Pages;

use App\Filament\Resources\PartnerLocations\PartnerLocationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPartnerLocation extends EditRecord
{
    protected static string $resource = PartnerLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Sorts\Pages;

use App\Filament\Resources\Sorts\SortResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSort extends ViewRecord
{
    protected static string $resource = SortResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

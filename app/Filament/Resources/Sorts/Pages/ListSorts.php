<?php

namespace App\Filament\Resources\Sorts\Pages;

use App\Filament\Resources\Sorts\SortResource;
use Filament\Resources\Pages\ListRecords;

class ListSorts extends ListRecords
{
    protected static string $resource = SortResource::class;

    protected function getHeaderActions(): array
    {
        // Read-only dataset: sorts are created exclusively by the app.
        return [];
    }
}

<?php

namespace App\Filament\Resources\Sorts\Pages;

use App\Filament\Resources\Sorts\SortResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSorts extends ListRecords
{
    protected static string $resource = SortResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

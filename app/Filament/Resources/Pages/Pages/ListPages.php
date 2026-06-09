<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Pages\SiteSettings;
use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('siteSettings')
                ->label('Site settings')
                ->icon('heroicon-o-cog-6-tooth')
                ->url(SiteSettings::getUrl()),
            CreateAction::make(),
        ];
    }
}

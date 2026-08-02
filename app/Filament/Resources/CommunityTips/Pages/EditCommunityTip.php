<?php

namespace App\Filament\Resources\CommunityTips\Pages;

use App\Filament\Resources\CommunityTips\CommunityTipResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCommunityTip extends EditRecord
{
    protected static string $resource = CommunityTipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

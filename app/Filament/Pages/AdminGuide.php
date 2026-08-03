<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class AdminGuide extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Admin Guide';

    protected static ?string $title = 'Admin Guide — how everything works';

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.admin-guide';
}

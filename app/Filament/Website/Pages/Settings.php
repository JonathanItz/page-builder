<?php

namespace App\Filament\Website\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.website.pages.settings';

    // TODO
    // For V2, set this to true so we can start adding settings
    public static function canAccess(): bool
    {
        return false;
    }
}
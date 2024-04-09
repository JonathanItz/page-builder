<?php

namespace App\Filament\Website\Resources\PageResource\Pages;

use App\Filament\Website\Resources\PageResource;
use Filament\Resources\Pages\Page;

class Settings extends Page
{
    protected static string $resource = PageResource::class;

    protected static string $view = 'filament.website.resources.page-resource.pages.settings';
}

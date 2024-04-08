<?php

namespace App\Filament\Website\Resources\PageResource\Pages;

use App\Filament\Website\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        // TODO
        // Make sure that the user has a subscription.
        // Hide 'Actions\CreateAction::make(),' if they don't.
        // Optionally: create a new action to redirect them to the billing page
        return [
            Actions\CreateAction::make(),
        ];
    }
}

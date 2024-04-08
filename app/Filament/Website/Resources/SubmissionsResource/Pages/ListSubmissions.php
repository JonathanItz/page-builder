<?php

namespace App\Filament\Website\Resources\SubmissionsResource\Pages;

use App\Filament\Website\Resources\SubmissionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmissions extends ListRecords
{
    protected static string $resource = SubmissionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

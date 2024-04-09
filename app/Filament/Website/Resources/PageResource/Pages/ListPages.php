<?php

namespace App\Filament\Website\Resources\PageResource\Pages;

use App\Models\Page;
use Filament\Actions;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Website\Resources\PageResource;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    public function getSubheading(): ?string
    {
        $user = auth()->user();
        $userId = $user->id;
        $pagesCount = Page::where('user_id', $userId)->count();

        if($pagesCount >= 5) {
            return new HtmlString("You've reached the maximum number of pages.");
        }

        return null;
    }

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

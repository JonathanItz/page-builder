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
        $maxPages = userHasReachedMaxPages();

        $subheading = '';

        if($maxPages) {
            $subheading = "You've reached the maximum number of pages. ";
        }

        $daysLeft = getDaysLeftInTrial();

        if($daysLeft !== false) {
            $subheading = $subheading . "You have $daysLeft days left in your trial.";
        }

        return $subheading;
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

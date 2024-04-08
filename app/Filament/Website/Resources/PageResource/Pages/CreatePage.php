<?php

namespace App\Filament\Website\Resources\PageResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Website\Resources\PageResource;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['random_id'] = microtime(true);
        $data['slug'] = Str::slug($data['title']);
    
        return $data;
    }

    protected function beforeCreate(): void
    {
        // // TODO
        // // Make sure that the user has a subscription

        // // if (! auth()->user()->team->subscribed()) {
        //     Notification::make()
        //         ->warning()
        //         ->title('You don\'t have an active subscription!')
        //         ->body('Choose a plan to continue.')
        //         ->persistent()
        //         // ->actions([
        //         //     Action::make('subscribe')
        //         //         ->button()
        //         //         ->url(route('subscribe'), shouldOpenInNewTab: true),
        //         // ])
        //         ->send();
        
        //     $this->halt();
        // // }
    }
}

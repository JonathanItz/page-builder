<?php

namespace App\Filament\Website\Resources\PageResource\Pages;

use App\Models\Page;
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
        $user = auth()->user();
        $site = $user->site;

        $data['user_id'] = $user->id;
        $data['site_id'] = $site->id;
        $data['slug'] = Str::slug($data['title']);

        if($data['content']) {
            foreach($data['content'] as $key => $content) {
                if($content['type'] === 'form' && array_key_exists($key, $data['content'])) {
                    if(! array_key_exists('id', $data['content'][$key]['data']) ||
                    array_key_exists('id', $data['content'][$key]['data']) &&
                    (! isset($data['content'][$key]['data']['id']) || $data['content'][$key]['data']['id'] === null)) {
                        $data['content'][$key]['data']['id'] = $data['slug'] . '-' . rand(100, 999);
                    }
                }
            }
        }

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

    static function canCreateAnother(): bool {
        return ! userHasReachedMaxPages(4);
    }
}

<?php

namespace App\Filament\Website\Resources\PageResource\Pages;

use App\Models\Page;
use Filament\Actions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Website\Resources\PageResource;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['title']);

        $id = $this->record->id;
        $page = Page::find($id);
        $currentPageContent = $page?->content;

        // delete the from storage if it was removed from the Filment builder
        if($currentPageContent && $data['content']) {
            foreach($currentPageContent as $key => $content) {
                if($content['type'] === 'image') {
                    $file = $content['data']['image'];

                    if($file && ! str_contains(json_encode($data['content']), $file)) {
                        Storage::delete("/public/$file");
                    }
                }

                if($content['type'] === 'form' && array_key_exists($key, $data['content'])) {
                    if(! array_key_exists('id', $data['content'][$key]['data']) ||
                    array_key_exists('id', $data['content'][$key]['data']) &&
                    (! isset($data['content'][$key]['data']['id']) || $data['content'][$key]['data']['id'] === null)) {
                        $data['content'][$key]['data']['id'] = rand(100000, 999999);
                    }
                }
            }
        }

        return $data;
    }
}

<?php

namespace App\Filament\Website\Pages;

use Filament\Pages\Page;
use Illuminate\Validation\Rule;
use Filament\Notifications\Notification;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $title = 'Site Settings';
    
    protected static ?string $navigationGroup = 'Pages';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.website.pages.settings';

    public $brandColor = '#0891b2';

    public $backgroundPattern = 'white';

    public $possiblePatterns = ['white', 'gray', 'polka', 'polka2'];

    public $site;

    public function mount() {
        $user = auth()->user();
        $site = $user->site;
        $this->site = $site;

        $settings = $site->settings;

        if($settings) {
            foreach($settings as $key => $setting) {
                if(property_exists($this, $key)) {
                    $this->{$key} = $setting;
                }
            }
        }
    }

    public function submitStyles() {
        $site = $this->site;
        $siteSettings = $site->settings;

        $this->validate(
            [
                'brandColor' => ['hex_color'],
                'backgroundPattern' => [Rule::in($this->possiblePatterns)],
            ]
        );

        $settings = [
            'brandColor' => $this->brandColor,
            'backgroundPattern' => $this->backgroundPattern,
        ];

        foreach($settings as $key => $setting) {
            $siteSettings[$key] = $setting;
        }

        $site->settings = $siteSettings;
        $site->save();

        Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 
    }

    // public static function canAccess(): bool
    // {
    //     return false;
    // }
}

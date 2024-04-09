<?php

namespace App\Filament\Website\Widgets;

use Filament\Widgets\Widget;

class DashboardSubscriptionStatus extends Widget
{
    protected static string $view = 'filament.website.widgets.dashboard-subscription-status';

    public $hasAccess = false;
    public $hasTrial = false;

    public $trialTimeLeft;

    public function mount() {
        $user = auth()->user();
        
        if($user->onTrial()) {
            $this->hasAccess = true;
            $this->hasTrial = true;

            $this->trialTimeLeft = getDaysLeftInTrial();
        }

        if($user->subscribed()) {
            $this->hasAccess = true;
        }
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function __construct(
        public $showNavigation = true, 
        public $title = 'Igloo Pages',
        public $backgroundPattern = '',
    ) {
        if($this->backgroundPattern) {
            switch ($this->backgroundPattern) {
                case 'gray':
                    $this->backgroundPattern = 'bg-gray-800 dark';
                    break;
                case 'white':
                    $this->backgroundPattern = 'bg-white';
                    break;
            }
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}

<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('home');

Route::get('/dashboard', function() {
    return redirect()->route('filament.website.pages.dashboard');
})
->name('dashboard');

Route::get('/{unique_id}/{slug}', [PagesController::class, 'show'])
    ->name('page');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

require __DIR__.'/auth.php';

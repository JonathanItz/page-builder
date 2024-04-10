<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function show($randomId, $slug) {
        $page = Page::where('random_id', $randomId)
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->first();

        if(! $page) {
            return abort(404);
        }

        $allPages = Page::where('user_id', $page->user_id)
            ->where('status', 'published')
            ->get();

        $routeParameters = Route::getCurrentRoute()->parameters();
        $uniqueId = $routeParameters['unique_id'];

        return view('pages.page', [
            'page' => $page,
            'allPages' => $allPages,
            'uniqueId' => $uniqueId,
        ]);
    }
}

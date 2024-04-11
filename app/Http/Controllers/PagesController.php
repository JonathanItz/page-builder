<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function show($siteId, $slug) {
        $page = Page::where('site_id', $siteId)
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->with('site')
                    ->first();

        if(! $page) {
            return abort(404);
        }

        $settings = [
            'brandColor' => '#0891b2',
            'backgroundPattern' => 'white',
        ];

        $siteSettings = $page->site->settings;

        if(isset($siteSettings) && ! empty($siteSettings)) {
            foreach($siteSettings as $key => $setting) {
                $settings[$key] = $setting;
            }
        }

        $allPages = Page::where('site_id', $page->site_id)
            ->where('status', 'published')
            ->orderBy('sort')
            ->get();

        $routeParameters = Route::getCurrentRoute()->parameters();
        $slug = $routeParameters['slug'];

        return view('pages.page', [
            'page' => $page,
            'allPages' => $allPages,
            'slug' => $slug,
            'settings' => $settings,
        ]);
    }
}

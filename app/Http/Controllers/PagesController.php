<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function show($unique_id, $slug) {
        $site = Site::where('unique_id', $unique_id)
        ->with(['user', 'pages'])
        ?->first();

        if(! hasAccess($site->user)) {
            return abort(404);
        }

        $pages = $site
        ?->pages()
        ?->where('status', 'published')
        ?->orderBy('sort', 'desc')
        ?->get();

        $page = $pages
            ->where('slug', $slug)
            // ->where('status', 'published')
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

        $routeParameters = Route::getCurrentRoute()->parameters();
        $slug = $routeParameters['slug'];

        return view('pages.page', [
            'page' => $page,
            'allPages' => $pages,
            'slug' => $slug,
            'settings' => $settings,
            'uniqueId' => $unique_id
        ]);
    }
}

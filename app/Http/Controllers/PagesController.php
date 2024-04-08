<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

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

        return view('pages.page', [
            'page' => $page
        ]);
    }
}

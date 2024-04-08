<?php

namespace App\Filament\Resources\BlogPostsResource\Pages;

use App\Filament\Resources\BlogPostsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPosts extends CreateRecord
{
    protected static string $resource = BlogPostsResource::class;
}

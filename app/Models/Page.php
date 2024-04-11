<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function submissions() {
        return $this->hasMany(FormSubmission::class);
    }

    public function site() {
        return $this->belongsTo(Site::class);
    }
}

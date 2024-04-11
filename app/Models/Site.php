<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $casts = [
        'settings' => 'array'
    ];

    public function pages() {
        return $this->hasMany(Page::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

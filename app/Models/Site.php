<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

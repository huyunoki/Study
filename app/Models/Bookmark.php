<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'place_id',
    ];

    // ブックマークをしたユーザー (多対1)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ブックマークされた投稿 (多対1)
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}

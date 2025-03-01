<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // タグが付与された投稿 (多対多)
    public function places()
    {
        return $this->belongsToMany(Place::class, 'place_tags', 'tag_id', 'place_id');
    }
}

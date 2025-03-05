<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // カテゴリーに属する投稿 (1対多)
    public function places()
    {
        return $this->hasMany(Place::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

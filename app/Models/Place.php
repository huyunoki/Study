<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 投稿のカテゴリー (多対1)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // 投稿に付与されたタグ (多対多)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'place_tags', 'place_id', 'tag_id');
    }

    // ブックマーク (1対多)
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'place_id');
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'study_date',
        'study_time',
        'created_at',
        'updated_at',
    ];
}

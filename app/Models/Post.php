<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'sku',
        'image',
        'author',
        'description',
        'content',
        'view',
        'is_active',
        'is_trending',
        'is_popular',
        'is_show_home',
    ];
    protected $casts = [
        'is_active',
        'is_trending',
        'is_popular',
        'is_show_home',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}


}

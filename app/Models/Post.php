<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'user_id', 'title', 'slug', 'excerpt', 'content', 'status', 'image', 'views'
    ];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_tag', 'tag_id', 'post_id');
    }

    public function posttags()
    {
        return $this->hasMany(PostTag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

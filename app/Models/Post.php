<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    const IS_PUBLISH = 1;
    const IS_DRAFT = 0;

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

    public function getStatus()
    {
        if ($this->status == self::IS_PUBLISH) {
            return 'Publish';
        }
        return 'Draft';
    }

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
        return $this->belongsToMany(Tag::class, 'post_tag');
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

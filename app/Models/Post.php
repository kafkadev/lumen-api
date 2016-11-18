<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    const IS_PUBLISH = 1;
    const IS_DRAFT = 0;
    const IS_CAKES = 2;
    const IS_TECHS = 1;

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

    public function getImageAttribute($value)
    {
        if ($value != '') {
            return $value;
        }
        if ($this->category_id == 1) {
            return asset('theme/img/home-bg.jpg');
        }
        return asset('theme/img/post-cake.jpg');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function scopeTechs($query)
    {
        return $query->where('category_id', self::IS_TECHS);
    }

    public function scopeCakes($query)
    {
        return $query->where('category_id', self::IS_CAKES);
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

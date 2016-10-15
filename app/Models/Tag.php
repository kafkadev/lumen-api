<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

	public $timestamps = false;

    public function posttags()
    {
        return $this->hasMany(PostTag::class);
    }

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'post_tag');
	}

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}

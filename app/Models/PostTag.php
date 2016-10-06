<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tag';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id', 'post_id'
    ];

	protected $table = 'post_tag';

    public $timestamps = false;

	public function posts()
	{
		return $this->belongsTo(Post::class);
	}

	public function tags()
	{
		return $this->hasOne(Tag::class);
	}

}

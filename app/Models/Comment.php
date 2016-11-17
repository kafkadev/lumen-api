<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'msg', 'seen'
    ];

    protected $guarded = ['id'];

    const IS_READ = 1;

    public function isRead()
    {
        return $this->seen == self::IS_READ;
    }
}

<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'api_token', 'role',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token'
    ];

    const IS_ADMIN = 1;
    const IS_USER = 0;

    public function isAdmin()
    {
        return $this->role == self::IS_ADMIN;
    }

    public function getRoleName()
    {
        if ($this->role == self::IS_ADMIN) {
            return 'ADMIN';
        }
        return 'USER';
    }

    protected function getAllRoles()
    {
        return [
            self::IS_USER => 'User',
            self::IS_ADMIN => 'Admin',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

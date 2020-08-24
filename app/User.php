<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'enabled',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Query scope

    /**
     * Query builder by name
     *
     * @param [type] $query
     * @param [type] $name
     * @return builder $query
     */
    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'LIKE', "%$name%");
        }
    }

    /**
     * Query builder by email
     *
     * @param [type] $query
     * @param [type] $email
     * @return builder $query
     */

    public function scopeEmail($query, $email)
    {
        if ($email) {
            return $query->where('email', 'LIKE', "%$email%");
        }
    }

    /**
     * Query builder by state
     *
     * @param [type] $query
     * @param [type] $enabled
     * @return builder $query
     */
    public function scopeEnabled($query, $enabled)
    {
        if ($enabled) {
            return $query->where('enabled', false);
        }
    }
}

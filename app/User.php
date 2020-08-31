<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
// use Illuminate\Database\Query\Builder;

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
     * @param Builder $query
     * @param string $name
     * @return EloquentBuilder $query
     */
    public function scopeName($query, $name): EloquentBuilder
    {
        if ($name) {
            return $query->where('name', 'LIKE', "%$name%");
        }
        return $query;
    }

    /**
     * Query builder by email
     *
     * @param Builder $query
     * @param string $email
     * @return EloquentBuilder $query
     */
    public function scopeEmail($query, $email): EloquentBuilder
    {
        if ($email) {
            return $query->where('email', 'LIKE', "%$email%");
        }
        return $query;
    }

    /**
     * Query builder by state
     *
     * @param Builder $query
     * @param bool $enabled
     * @return EloquentBuilder $query
     */
    public function scopeEnabled($query, $enabled): EloquentBuilder
    {
        if ($enabled) {
            return $query->where('enabled', false);
        }
        return $query;
    }
}

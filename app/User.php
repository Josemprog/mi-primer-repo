<?php

namespace App;

use App\Cart;
use App\Order;
use App\Payment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

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
        'admin',
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

    //--------------------Relations---------------------------------------------


    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function payments(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Order::class, 'customer_id');
    }

    //------------Query scope-----------------------------

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

<?php

namespace App;

use App\Cart;
use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;



class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand',
        'name',
        'price',
        'quantity',
        'description',
        'image',
        'enabled',
    ];

    //--------------------Relations---------------------------------------------

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function carts(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    //---------------------Getters----------------------------------------

    /**
     * The total amount of the payment to be made is obtained
     *
     * @return void
     */
    public function getTotalAttribute()
    {
        return $this->pivot->quantity * $this->price;
    }

    //--------------------Query scope--------------------------------------------------

    /**
     * Query builder by brand
     *
     * @param Builder $query
     * @param string $brand
     * @return EloquentBuilder $query
     */
    public function scopeBrand($query, $brand): EloquentBuilder
    {
        if ($brand) {
            return $query->where('brand', 'LIKE', "%$brand%");
        }
        return $query;
    }

    /**
     * query builder by name
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
     * query builder by price
     *
     * @param Builder $query
     * @param int $price
     * @return EloquentBuilder $query
     */
    public function scopePrice($query, $price): EloquentBuilder
    {
        if ($price) {
            return $query->where('price', 'LIKE', "%$price%");
        }
        return $query;
    }

    /**
     * query builder by state
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

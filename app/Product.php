<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
// use Illuminate\Database\Query\Builder;



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
        'unit_price',
        'quantity',
        'description',
        'image',
        'enabled'
    ];

    //Query scope

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
     * @param int $unit_price
     * @return EloquentBuilder $query
     */
    public function scopeUnit_price($query, $unit_price): EloquentBuilder
    {
        if ($unit_price) {
            return $query->where('unit_price', 'LIKE', "%$unit_price%");
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

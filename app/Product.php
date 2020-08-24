<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @param [type] $query
     * @param [type] $brand
     * @return builder $query
     */
    public function scopeBrand($query, $brand)
    {
        if ($brand) {
            return $query->where('brand', 'LIKE', "%$brand%");
        }
    }

    /**
     * query builder by name
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
     * query builder by email
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
     * query builder by price
     *
     * @param [type] $query
     * @param [type] $unit_price
     * @return builder $query
     */
    public function scopeUnit_price($query, $unit_price)
    {
        if ($unit_price) {
            return $query->where('unit_price', 'LIKE', "%$unit_price%");
        }
    }

    /**
     * query builder by state
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

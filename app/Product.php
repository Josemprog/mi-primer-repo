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
        'brand', 'name', 'unit_price', 'quantity', 'description', 'image', 'enabled'
    ];

    //Query scope

    public function scopeBrand($query, $brand)
    {
        if ($brand) {
            return $query->where('brand', 'LIKE', "%$brand%");
        }
    }

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'LIKE', "%$name%");
        }
    }

    public function scopeEmail($query, $email)
    {
        if ($email) {
            return $query->where('email', 'LIKE', "%$email%");
        }
    }

    public function scopeUnit_price($query, $unit_price)
    {
        if ($unit_price) {
            return $query->where('unit_price', 'LIKE', "%$unit_price%");
        }
    }

    public function scopeEnabled($query, $enabled)
    {
        if ($enabled) {
            return $query->where('enabled', false);
        }
    }
}

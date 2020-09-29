<?php

namespace App;

// use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    //---------------------Getters----------------------------------------

    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }
}

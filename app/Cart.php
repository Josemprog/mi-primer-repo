<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //---------------------Getters----------------------------------------

    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }
}

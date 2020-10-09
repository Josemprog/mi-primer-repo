<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    /**
     * defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //---------------------Getters----------------------------------------

    /**
     * The total amount of the payment to be made is obtained
     *
     * @return void
     */
    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }
}

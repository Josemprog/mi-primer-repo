<?php

namespace App;

use App\User;
use App\Payment;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'customer_id',
    ];

    //--------------------Relations---------------------------------------------


    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

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

<?php

namespace App;

use App\User;
use App\Payment;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';
    public const PENDING = 'pending';
    public const IN_PROCESS = 'in_process';

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

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Defines the relationships between models
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
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

<?php

namespace App\Services;

use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{

  public function getCartFromUser()
  {

    return Auth::user()->cart()->first();
  }



  public function getFromUserOrCreate()
  {
    $cart = $this->getCartFromUser();

    return $cart ?? Auth::user()->cart()->create();
  }


  public function countProductsInCart()
  {
    $cart = $this->getCartFromUser();

    if ($cart != null) {
      return $cart->products->pluck('pivot.quantity')->sum();
    }
    return 0;
  }
}

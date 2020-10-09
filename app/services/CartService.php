<?php

namespace App\Services;

use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
  /**
   * returns the user's first cart
   *
   * @return void
   */
  public function getCartFromUser()
  {

    return Auth::user()->cart()->first();
  }


  /**
   * The user's cart is selected or a new cart is created for the user
   *
   * @return void
   */
  public function getFromUserOrCreate()
  {
    $cart = $this->getCartFromUser();

    return $cart ?? Auth::user()->cart()->create();
  }

  /**
   * the products in the cart are counted
   *
   * @return void
   */
  public function countProductsInCart()
  {
    $cart = $this->getCartFromUser();

    if ($cart != null) {
      return $cart->products->pluck('pivot.quantity')->sum();
    }
    return 0;
  }
}

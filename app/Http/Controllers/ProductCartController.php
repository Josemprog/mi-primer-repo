<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Services\CartService;

class ProductCartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Product $product): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->cartService->getFromUserOrCreate();

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1],
        ]);

        return redirect()->back();
    }


    /**
     * Remove only one product from cart
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeOne(Product $product, Cart $cart): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->cartService->getFromUserOrCreate();

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        if ($quantity <= 1) {
            $cart->products()->detach($product->id);

            return redirect()->back();
        } else {
            $cart->products()->syncWithoutDetaching([
                $product->id => ['quantity' => $quantity - 1],
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified product from cart.
     *
     * @param  \App\Product  $product
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product, Cart $cart): \Illuminate\Http\RedirectResponse
    {
        $cart->products()->detach($product->id);

        return redirect()->back();
    }
}

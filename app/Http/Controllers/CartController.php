<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartController extends Controller
{

    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        return view('cart.index')->with([
            'cart' => $this->cartService->getFromUserOrCreate(),
        ]);
    }
}

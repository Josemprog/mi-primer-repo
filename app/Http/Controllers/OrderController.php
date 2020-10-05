<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\CartService;
use App\Services\PlaceToPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $cartService;
    public $p2p;

    public function __construct(CartService $cartService, PlaceToPayService $p2p)
    {
        $this->cartService = $cartService;
        $this->p2p = $p2p;


        $this->middleware('auth');
    }


    /**
     * Display a listing of the Orders of User.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        $orders = Order::where('customer_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Display the specified product.
     *
     * @param  Product $product
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Order $order): \Illuminate\View\View
    {

        $payment = $this->p2p->createRequest($order, $request);


        $payment = $this->p2p->getInformation($payment['requestId']);

        return view('orders.show')->with(['payment' => $payment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->cartService->getCartFromUser();

        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors("Your cart is empty");
        } else {

            $user = $request->user();

            $order = $user->orders()->create([
                'status' => 'pending',
            ]);

            $cart = $this->cartService->getCartFromUser();

            $cartProductsWithQuantity = $cart
                ->products
                ->mapWithKeys(function ($product) {
                    $element[$product->id] = ['quantity' => $product->pivot->quantity];

                    return $element;
                });

            $order->products()->attach($cartProductsWithQuantity->toArray());

            return redirect()->route('orders.payments.create', ['order' => $order]);
        }
    }
}

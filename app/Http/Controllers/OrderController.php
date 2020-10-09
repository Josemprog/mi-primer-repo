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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments.pay')->with([
            'cart' => $this->cartService->getFromUserOrCreate(),
        ]);
    }

    /**
     * Display the specified product.
     *
     * @param  Product $product
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Order $order): \Illuminate\View\View
    {
        // $payment = $this->p2p->createRequest($order, $request);
        // dd($order->toArray());
        $payment = $this->p2p->getInformation($order->requestId);

        if ($order->status == 'PENDING') {

            // dd($order->status);

            $order->status = $payment['status']['status'];
            $order->save();
        }

        return view('orders.show')->with(['order' => $order, 'payment' => $payment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // obtengo el carro del usuario
        $cart = $this->cartService->getCartFromUser();

        // pregunto si el carro esta vacio
        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors("Your cart is empty");
        } else {

            // traigo el usuario

            $user = $request->user();

            // le creo la orden si no existe

            // dd($user->orders);

            if (!isset($order) || $user->orders->isEmpty()) {
                $order = $user->orders()->create([
                    'status' => 'PENDING',
                ]);

                $cartProductsWithQuantity = $cart
                    ->products
                    ->mapWithKeys(function ($product) {
                        $element[$product->id] = ['quantity' => $product->pivot->quantity];

                        return $element;
                    });

                // agrupo las ordenes en un arreglo

                $order->products()->attach($cartProductsWithQuantity->toArray());
            }

            $this->cartService->getCartFromUser()->products()->detach();

            // Consumo el api de Place to pay
            $payment = $this->p2p->createRequest($order, $request);

            $order->processUrl = $payment['processUrl'];
            $order->requestId = $payment['requestId'];
            $order->status = $payment['status']['status'];
            $order->save();

            // borro los productos del carrito


            if ($order->status == 'PENDING') {
                return redirect($payment['processUrl'])->with('message', "The payment was not completed, try again later when you want");
            }

            return redirect($payment['processUrl'])->with('message', "Thanks for your purchase! the payment has been processed correctly");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function retry(Request $request, Order $order)
    {

        $payment = $this->p2p->createRequest($order, $request);

        $order->processUrl = $payment['processUrl'];
        $order->requestId = $payment['requestId'];
        $order->save();


        $this->cartService->getCartFromUser()->products()->detach();

        if ($order->status == 'PENDING') {
            return redirect($payment['processUrl'])->with('message', "The payment was not completed, try again later when you want");
        }

        return redirect($payment['processUrl'])->with('message', "Thanks for your purchase! the payment has been processed correctly");
    }
}

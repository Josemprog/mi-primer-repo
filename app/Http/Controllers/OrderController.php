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
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        $orders = Order::where('customer_id', $user->id)
            ->orderBy('id', 'ASC')
            ->get();

        return view('orders.index')->with([
            'orders' => $orders,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('payments.pay')->with([
            'cart' => $this->cartService->getFromUserOrCreate(),
        ]);
    }

    /**s
     * Display the specified order.
     *
     * @param  Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): \Illuminate\View\View
    {

        $payment = $this->p2p->getInformation($order->requestId);

        if ($order->status == 'PENDING') {

            $order->status = $payment['status']['status'];
            $order->save();
        }

        return view('orders.show')
            ->with([
                'order' => $order,
                'payment' => $payment,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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

                $order->products()
                    ->attach($cartProductsWithQuantity->toArray());
            }

            // borro los productos del carrito
            $this->cartService->getCartFromUser()->products()->detach();

            // Consumo el api de Place to pay
            $payment = $this->p2p->createRequest($order, $request);

            $order->processUrl = $payment['processUrl'];
            $order->requestId = $payment['requestId'];
            $order->status = $payment['status']['status'];
            $order->save();

            return redirect($payment['processUrl']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retry(Request $request, Order $order): \Illuminate\Http\RedirectResponse
    {

        $payment = $this->p2p->createRequest($order, $request);

        $order->processUrl = $payment['processUrl'];
        $order->requestId = $payment['requestId'];
        $order->save();

        $this->cartService->getCartFromUser()->products()->detach();

        return redirect($payment['processUrl']);
    }
}

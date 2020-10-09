<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Services\CartService;
use App\Services\PlaceToPayService;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('payments.pay')->with([
            'order' => $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {

        $payment = $this->p2p->createRequest($order, $request);

        $order->processUrl = $payment['processUrl'];
        $order->requestId = $payment['requestId'];
        $order->save();

        $this->cartService->getCartFromUser()->products()->detach();

        return redirect($payment['processUrl'])->with('message', "Thanks for your purchase! the payment has been processed correctly");
    }
}

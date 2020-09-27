<?php

use App\User;
use App\Cart;
use App\Product;
use App\Order;
use App\Payment;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $orders = factory(Order::class, 10)
            ->make()
            ->each(function ($order) use ($users) {
                $order->customer_id = $users->random()->id;
                $order->save();

                $payment = factory(Payment::class)->make();
                $order->payment()->save($payment);
            });

        $carts = Cart::all();

        $products = Product::all()
            ->each(function ($product) use ($orders, $carts) {
                $order = $orders->random();

                $order->products()->attach([
                    $product->id => ['quantity' => mt_rand(1, 3)],
                ]);

                $cart = $carts->random();

                $cart->products()->attach([
                    $product->id => ['quantity' => mt_rand(1, 5)],
                ]);
            });
    }
}

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('products.carts', 'ProductCartController')->only(['store', 'destroy']);
    Route::patch('products/{product}/carts/{cart}', 'ProductCartController@removeOne')
        ->name('products.carts.removeOne');
    Route::resource('carts', 'CartController')->only(['index']);
    Route::resource('orders', 'OrderController');
    Route::post('orders/{order}', 'OrderController@retry')->name('orders.retry');
});

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::view('/', 'home')->name('home');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Admin routes
Route::resource('users', 'Admin\UserController')->middleware('verified', AdminVerify::class);
Route::get('admin/products/panel', 'Admin\ProductController@panel')->name('products.panel');
Route::resource('products', 'Admin\ProductController')->middleware('verified');

// Cart routes
Route::resource('products.carts', 'ProductCartController')->only(['store', 'destroy']);
Route::patch('products/{product}/carts/{cart}', 'ProductCartController@removeOne')->name('products.carts.removeOne');
Route::resource('carts', 'CartController')->only(['index']);

// Orders routes
Route::resource('orders', 'OrderController')->middleware('verified');
Route::post('orders/{order}', 'OrderController@retry')->name('orders.retry')->middleware('verified');

// Export
Route::get('/export', 'Admin\ProductController@export')->name('export');

// pruebas
Route::get('/lleve', function () {
    return 'lleve';
});

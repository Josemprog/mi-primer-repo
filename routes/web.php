<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::view('/', 'welcome')->name('welcome');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Admin routes
Route::resource('users', 'Admin\UserController')->middleware('verified', AdminVerify::class);

Route::get('admin/products/panel', 'Admin\ProductController@panel')->name('products.panel');
Route::resource('products', 'Admin\ProductController')->middleware('verified');

// Cart routes
Route::resource('products.carts', 'ProductCartController')->only(['store', 'destroy']);

Route::patch('products/{product}/carts/{cart}', 'ProductCartController@removeOne')->name('products.carts.removeOne');

Route::resource('carts', 'CartController')->only(['index']);


Route::resource('orders', 'OrderController')->only(['index', 'create', 'store', 'show']);
Route::resource('orders.payments', 'OrderPaymentController')->only(['create', 'store']);

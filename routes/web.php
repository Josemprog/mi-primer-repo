<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;

Auth::routes(['verify' => true]);
Route::view('/', 'home')->name('home');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Admin routes
Route::resource('users', 'Admin\UserController')->middleware('verified', CheckAdmin::class);
Route::get('admin/products/panel', 'Admin\ProductController@panel')->name('products.panel')->middleware('verified', CheckAdmin::class);
Route::resource('products', 'Admin\ProductController')->middleware('verified', CheckAdmin::class);

// Cart routes
Route::resource('products.carts', 'ProductCartController')->only(['store', 'destroy']);
Route::patch('products/{product}/carts/{cart}', 'ProductCartController@removeOne')->name('products.carts.removeOne');
Route::resource('carts', 'CartController')->only(['index']);

// Orders routes
Route::resource('orders', 'OrderController')->middleware('verified');
Route::post('orders/{order}', 'OrderController@retry')->name('orders.retry')->middleware('verified');

// Export
Route::get('/export', 'Admin\ProductController@export')->name('products.export');

// Import
Route::post('/import', 'Admin\ProductController@import')->name('products.import');

// pruebas
Route::get('/lleve', function () {
    return 'lleve';
});

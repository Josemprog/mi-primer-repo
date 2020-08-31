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

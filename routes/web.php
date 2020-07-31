<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');



Auth::routes(['verify' => true]);
Route::view('/', 'welcome')->name('welcome');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Admin routes
Route::resource('users', 'Admin\UserController')->middleware('verified', AdminVerify::class);

Route::get('admin/products/panel', 'Admin\ProductController@panel')->name('products.panel');
Route::resource('products', 'Admin\ProductController')->middleware('verified');

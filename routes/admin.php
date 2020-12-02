<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;

Route::group(['middleware' => ['role:admin']], function () {
    Route::middleware([CheckAdmin::class])->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('products', 'ProductController');
        Route::get('/export', 'ProductController@export')->name('products.export');
        Route::post('/import', 'ProductController@import')->name('products.import');
    });
});

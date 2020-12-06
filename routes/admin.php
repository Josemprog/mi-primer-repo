<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('panel', 'PanelController')->only('index');
    Route::resource('users', 'UserController');
    Route::resource('products', 'ProductController');
    Route::get('/export', 'ProductController@export')->name('products.export');
    Route::post('/import', 'ProductController@import')->name('products.import');
});

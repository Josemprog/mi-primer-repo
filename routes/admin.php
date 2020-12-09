<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role_or_permission:main-admin|Edit Products']], function () {
    Route::resource('products', 'ProductController');
});

Route::group(['middleware' => ['role:main-admin']], function () {
    Route::resource('panel', 'PanelController')->only('index');
    Route::resource('users', 'UserController');
    Route::get('/export', 'ProductController@export')->name('products.export');
    Route::post('/import', 'ProductController@import')->name('products.import');
});

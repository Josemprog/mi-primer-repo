<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role_or_permission:main-admin|Edit Products']], function () {
    Route::resource('products', 'ProductController')->except('show');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', 'ProductController')->only('show');
});


Route::group(['middleware' => ['role:main-admin']], function () {
    Route::resource('panel', 'PanelController')->only('index');
    Route::resource('users', 'UserController');

    Route::put('users/{user}/roles', 'UsersRolesController@update')->name('roles.update');
    Route::put('users/{user}/permissions', 'UsersPermissionsController@update')->name('permissions.update');
    Route::get('/export', 'ProductController@export')->name('products.export');
    Route::post('/import', 'ProductController@import')->name('products.import');
});

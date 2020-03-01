<?php

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


Route::get('/test', function() {
    
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/menu', function() {
        return view('admin.admin-menu-builder');
    });

    Route::get('/menu-iframe', function() {
        return view('admin.menu-builder');
    });
});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function() {
    Route::get('/menu', 'MenuController@index')->name('menu');

    Route::resource('/weeks', 'WeeksController');
    Route::get('/weeks/{week}/sync/{category}', 'WeeksController@sync');
    Route::delete('/weeks/{week}/sync/{category}', 'WeeksController@syncDelete');

    Route::resource('/categories', 'CategoriesController');

    Route::resource('/dishes', 'DishesController');
    Route::get('/dishes/sync/{week}/{category}/{dish}', 'DishesController@sync');
    Route::delete('/dishes/sync/{week}/{category}/{dish}', 'DishesController@syncDelete');

    Route::resource('/hash-tags', 'HashTagsController');
    Route::resource('/ingredients', 'IngredientsController');
    Route::resource('/instruments', 'InstrumentsController');

    Route::get('/test', function() {
        return ['name' => 'qwe'];
    });
});
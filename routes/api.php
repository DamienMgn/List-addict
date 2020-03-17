<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/categories', 'CategoriesController@showCategories')->name('show_categories');
Route::middleware('auth:api')->post('/add-category', 'CategoriesController@addCategory')->name('add_category');
Route::middleware('auth:api')->post('/delete/category/{category}', 'CategoriesController@deleteCategory')->name('delete_category')->middleware('categories');
Route::middleware('auth:api')->get('/cards/{category}', 'CardsController@showCards')->name('show_cards')->middleware('categories');
Route::middleware('auth:api')->post('/add-card/{category}', 'CardsController@addCard')->name('add_card')->middleware('categories');
Route::middleware('auth:api')->post('/delete/card/{card}/{category}', 'CardsController@deleteCard')->name('delete_card')->middleware('categories');


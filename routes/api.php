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

Route::middleware('auth:api')->get('/categories', 'CategoriesController@showCategories');
Route::middleware('auth:api')->post('/add-category', 'CategoriesController@addCategory');
Route::middleware('auth:api')->post('/delete/category/{category}', 'CategoriesController@deleteCategory')->middleware('categories');
Route::middleware('auth:api')->get('/cards/{category}', 'CardsController@showCards')->middleware('categories');
Route::middleware('auth:api')->post('/add-card/{category}', 'CardsController@addCard')->middleware('categories');
Route::middleware('auth:api')->post('/delete/card/{card}/{category}', 'CardsController@deleteCard')->middleware('categories', 'cards');
Route::middleware('auth:api')->post('/add-task/{card}/{category}', 'TasksController@addTask')->middleware('categories', 'cards');
Route::middleware('auth:api')->post('/delete/task/{task}/{card}/{category}', 'TasksController@deleteTask')->middleware('categories', 'cards', 'tasks');
Route::middleware('auth:api')->post('/update/task/{task}/{card}/{category}', 'TasksController@updateTask')->middleware('categories', 'cards', 'tasks');


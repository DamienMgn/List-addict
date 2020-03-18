<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoriesController@showCategories')->name('show_categories');

Route::get('/delete/{category}', 'CategoriesController@deleteCategory')->name('show_cards')->middleware('categories');

Route::get('/cards/{category}', 'CardsController@showCards')->name('show_cards');

Route::get('/delete/task/{task}/{card}/{category}', 'TasksController@deleteTask')->name('delete_task')->middleware('categories', 'cards', 'tasks');

Route::get('/delete/card/{card}/{category}', 'CardsController@deleteCard')->name('delete_card')->middleware('categories', 'cards');

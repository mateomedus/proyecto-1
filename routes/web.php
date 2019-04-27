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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::resource('posts','PostsController');
Route::get('/profile','ProfileController@index');
Route::get('/edit','ProfileController@edit');
Route::put('/update','ProfileController@update');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

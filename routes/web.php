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

Route::get('/readme', 'PagesController@readme');

Route::resource('posts','PostsController');
Route::resource('postsList','ListsController');
Route::resource('/profile','ProfileController');
Route::get('/edit','ProfileController@edit');
Route::put('/update','ProfileController@update');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

// Facebook socialite
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

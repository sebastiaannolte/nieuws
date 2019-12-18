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

Route::get('/', 'HomeController@index');
// Route::get('/', 'HomeController@index');


Route::get('/p/{slug}', 'HomeController@post');
// ->where('categories', '^[a-zA-Z0-9-_\/]+$');
Route::get('/{categories}', 'HomeController@category')
    ->where('categories', '^[a-zA-Z0-9-_\/]+$');

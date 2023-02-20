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

Route::get('/', 'App\Http\Controllers\uiController@index');
Route::get('/location', 'App\Http\Controllers\uiController@location');
Route::get('/user', 'App\Http\Controllers\uiController@user');
Route::get('/about', 'App\Http\Controllers\uiController@about');
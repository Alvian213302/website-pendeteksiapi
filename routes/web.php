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

Route::middleware(['auth'])->group(function () {
  Route::get('/', 'App\Http\Controllers\uiController@index');
  Route::get('/location', 'App\Http\Controllers\uiController@location');
  Route::get('/user', 'App\Http\Controllers\uiController@user');
  Route::get('/about', 'App\Http\Controllers\uiController@about');

  Route::get("/logout", "App\Http\Controllers\uiController@logout");

  Route::get("update-chart", "App\Http\Controllers\uiController@updateChart")->name("update-chart");
  Route::get("update-status", "App\Http\Controllers\uiController@updateStatus")->name("update-status");
  Route::get("update-suhu", "App\Http\Controllers\uiController@updateSuhu")->name("update-suhu");
});

Route::get("/login", "App\Http\Controllers\uiController@login")->name("login")->middleware("guest");
Route::post("/login", "App\Http\Controllers\uiController@loginAuth");

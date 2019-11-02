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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/share', 'HomeController@share')->name('share');
Route::post('/share', 'HomeController@share')->name('share');

Route::get('/purchase', 'HomeController@record')->name('history');
Route::post('/purchase/{id}', 'HomeController@purchase')->name('purchase');
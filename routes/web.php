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

Route::get('/', function () {
    return view('welcome');
});

Route::get('mtn-momo', 'TransactionController@create')->name('form_path');
Route::get('mtn-momo/view', 'TransactionController@index')->name('display_path');
Route::post('mtn-momo/store', 'TransactionController@store')->name('store_path');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

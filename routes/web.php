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

Route::middleware('auth')->any('/', 'ExchangeRateController@index')->name('home');


Route::middleware(['auth', 'check-if-admin'])->group(function () {
    Route::any('/admin/users', 'UserController@index')->name('index_users');
    Route::any('/admin/users/delete/{id}', 'UserController@destroy')->name('delete_user');
    Route::get('/admin/users/add', 'UserController@create')->name('add_user');
    Route::post('/admin/users/add', 'UserController@store')->name('create_user');
});

Auth::routes();

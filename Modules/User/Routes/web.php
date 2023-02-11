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

Route::prefix('user')->middleware('auth')->group(function() {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('data', 'UserController@data')->name('user.data');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
    Route::get('approve/{id}', 'UserController@approve')->name('user.approve');
    Route::get('decline/{id}', 'UserController@decline')->name('user.decline');
    Route::post('update/{id}', 'UserController@update')->name('user.update');
    Route::get('destroy/{id}', 'UserController@destroy')->name('user.destroy');
    Route::get('info', 'UserController@info')->name('user.info');
    Route::get('bulk/{data}', 'UserController@bulk')->name('user.bulk');
    Route::get('setCashier/{id}', 'UserController@setCashier')->name('user.setCashier');
    Route::get('setRegular/{id}', 'UserController@setRegular')->name('user.setRegular');
});

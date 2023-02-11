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

Route::prefix('cashier')->group(function() {
    Route::get('/', 'CashierController@index')->name('cashier.index');
    Route::get('data', 'CashierController@data')->name('cashier.data');
});

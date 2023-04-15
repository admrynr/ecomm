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

Route::prefix('admin/product')->middleware('auth')->group(function() {
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::post('store', 'ProductController@store')->name('product.store');
    Route::get('data', 'ProductController@data')->name('product.data');
    Route::get('info', 'ProductController@info')->name('product.info');
    Route::get('bulk/{data}', 'ProductController@bulk')->name('product.bulk');
    Route::get('edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::get('approve/{id}', 'ProductController@approve')->name('product.approve');
    Route::get('decline/{id}', 'ProductController@decline')->name('product.decline');
    Route::post('update/{id}', 'ProductController@update')->name('product.update');
    Route::get('destroy/{id}', 'ProductController@destroy')->name('product.destroy');
    Route::get('category', 'ProductController@category')->name('product.category');
});

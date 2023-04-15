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

Route::prefix('admin/category')->middleware('auth')->group(function() {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::get('data', 'CategoryController@data')->name('category.data');
    Route::get('info', 'CategoryController@info')->name('category.info');
    Route::get('destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
    Route::get('bulk/{data}', 'CategoryController@bulk')->name('category.bulk');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::post('update/{id}', 'CategoryController@update')->name('category.update');
    Route::get('edit/{id}', 'CategoryController@edit')->name('category.edit');
});

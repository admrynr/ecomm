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

Route::prefix('admin/color')->middleware('auth')->group(function() {
    Route::get('/', 'ColorController@index')->name('color.index');
    Route::post('store', 'ColorController@store')->name('color.store');
    Route::get('data', 'ColorController@data')->name('color.data');
    Route::get('info', 'ColorController@info')->name('color.info');
    Route::get('bulk/{data}', 'ColorController@bulk')->name('color.bulk');
    Route::get('edit/{id}', 'ColorController@edit')->name('color.edit');
    Route::get('approve/{id}', 'ColorController@approve')->name('color.approve');
    Route::get('decline/{id}', 'ColorController@decline')->name('color.decline');
    Route::post('update/{id}', 'ColorController@update')->name('color.update');
    Route::get('destroy/{id}', 'ColorController@destroy')->name('color.destroy');
    Route::get('category', 'ColorController@category')->name('color.category');;
});

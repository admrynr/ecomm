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

Route::prefix('admin/brand')->middleware('auth')->group(function() {
    Route::get('/', 'BrandController@index')->name('brand.index');
    Route::get('data', 'BrandController@data')->name('brand.data');
    Route::get('info', 'BrandController@info')->name('brand.info');
    Route::get('destroy/{id}', 'BrandController@destroy')->name('brand.destroy');
    Route::get('bulk/{data}', 'BrandController@bulk')->name('brand.bulk');
    Route::post('store', 'BrandController@store')->name('brand.store');
    Route::post('update/{id}', 'BrandController@update')->name('brand.update');
    Route::get('edit/{id}', 'BrandController@edit')->name('brand.edit');
});

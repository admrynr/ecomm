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
    return view('index');

});

Route::get('/login', function (){
    return view('login');
});

Route::get('/blog', function (){
    return view('blog');
});

Route::get('/blog', function (){
    return view('blog');
});

Route::get('/video', function (){
    return view('video');
});

Route::get('/livestream', function (){
    return view('livestream');
});

Route::get('/admin', '\Modules\User\Http\Controllers\UserController@index')->name('home')->middleware('auth');
Route::get('/index', 'HomeController@index')->name('index');

Route::get('main', 'DefaultController@index');
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/list', 'ListModelController@index')->name('list');
Route::get('/list/add', 'ListModelController@add')->name('add');
Route::post('/list/store', 'ListModelController@store')->name('store');
Route::get('/list/edit/{id}', 'ListModelController@edit')->name('edit');
Route::post('/list/update/{id}', 'ListModelController@update')->name('update');
Route::get('/list/hapus/{id}', 'ListModelController@delete')->name('hapus');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/unverified', 'LoginController@unverify')->name('unverified');
Route::get('/wrong', 'LoginController@wrong')->name('wrong');
Route::get('/login/regsuccess', 'LoginController@regsuccess')->name('regsuccess');
Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login/authenticate', 'loginController@authenticate')->name('authenticate');

Route::get('/register', 'RegController@index')->name('register');
Route::post('/register/store', 'RegController@register')->name('store');

Route::get('/authuser', 'AuthenticateUserController@index')->name('authuser');
Route::get('/verify/{id}', 'AuthenticateUserController@verify')->name('verify');



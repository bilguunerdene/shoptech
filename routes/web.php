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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/settings', 'SettingsController@index')->name('settings');

Route::resource('type', 'TypeController');

Route::resource('product', 'ProductController');

Route::post('login', 'Auth\LoginController@login');

Route::post('update-cart', 'CartController@update');
 
Route::delete('remove-from-cart', 'CartController@remove');

Route::delete('removeall-from-cart', 'CartController@removeAll');

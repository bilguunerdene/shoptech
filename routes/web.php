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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'HomeController@search')->name('search');

Route::get('/filter', 'HomeController@filter')->name('filter');

Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/settings', 'SettingsController@index')->name('settings');

Route::resource('type', 'TypeController');

Route::resource('branch', 'BranchController');

Route::resource('product', 'ProductController');

Route::post('login', 'Auth\LoginController@login');

Route::post('update-cart', 'CartController@update');

Route::post('minus', 'CartController@minus');
 
Route::get('remove-from-cart/{id}', 'CartController@remove')->name('remove-from-cart');

Route::delete('removeall-from-cart', 'CartController@removeAll');

Route::get('lang/{locale}','LocalizationController@index');

Route::resource("order","OrderController");
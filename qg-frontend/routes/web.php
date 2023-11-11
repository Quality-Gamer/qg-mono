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

Route::get('/', 'HomeController@index');
// Route::get('/login', 'HomeController@login');
Route::post('/login', 'HomeController@login')->name('login');
Route::post('/logout', 'HomeController@logout');
Route::get('/logout', 'HomeController@logout');
Route::get('/manager', 'ManagerController@index');
Route::post('/manager', 'ManagerController@index');
Route::get('/manager/reset', 'ManagerController@reset');
Route::get('/tests', 'TestsController@index');
Route::get('/register', 'HomeController@register');
Route::post('/create/user', 'HomeController@createUser');
Route::get('/forgot', 'HomeController@forgot');
Route::get('/ranking','RankingController@index');
Route::get('/profile', 'HomeController@profile');
Route::get('/token/{token}', 'HomeController@token');
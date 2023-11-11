<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', ['middleware' => 'cors', 'uses' => 'UserController@login']);
Route::post('/user', ['middleware' => 'cors', 'uses' => 'UserController@user']);
Route::post('/tests/load', ['middleware' => 'cors', 'uses' => 'TestsController@loadAllowTests']);
Route::post('/tests/done', ['middleware' => 'cors', 'uses' => 'TestsController@loadDoneTests']);
Route::post('/tests/questions', ['middleware' => 'cors', 'uses' => 'TestsController@getQuestions']);
Route::post('/tests/save', ['middleware' => 'cors', 'uses' => 'TestsController@saveTests']);
Route::get('/load/users', ['middleware' => 'cors', 'uses' => 'UserController@loadUsers']);
Route::post('/challenge/create', ['middleware' => 'cors', 'uses' => 'ChallengeController@create']);
Route::get('/challenge/load', ['middleware' => 'cors', 'uses' => 'ChallengeController@load']);
Route::post('/challenge/join', ['middleware' => 'cors', 'uses' => 'ChallengeController@join']);
Route::get('/universities', ['middleware' => 'cors', 'uses' => 'UserController@getUniversities']);
Route::post('/create/user', ['middleware' => 'cors', 'uses' => 'UserController@create']);
Route::post('/change/password', ['middleware' => 'cors', 'uses' => 'UserController@changePassword']);
Route::post('/forget', ['middleware' => 'cors', 'uses' => 'UserController@createToken']);
Route::get('/token', ['middleware' => 'cors', 'uses' => 'UserController@tokenValid']);
Route::post('/update/score', ['middleware' => 'cors', 'uses' => 'UserController@updateScore']);
Route::get('/get/users', ['middleware' => 'cors', 'uses' => 'UserController@getUsers']);
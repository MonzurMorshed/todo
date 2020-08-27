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


Auth::routes(['verify' => true]);

Route::get('/', 'TaskController@index');
Route::post('/task/save', 'TaskController@store');
Route::get('/task/restore/{id}', 'TaskController@restore');
Route::get('/task/delete/{id}', 'TaskController@destroy');
Route::post('/task/update', 'TaskController@update');

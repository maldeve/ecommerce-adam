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
    return view('welcome');
});

// Category Routes
Route::get('/categories', 'CategoryController@index');
Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories', 'CategoryController@store');
Route::get('/categories/edit/{id}', 'CategoryController@edit');
Route::patch('/categories/{id}', 'CategoryController@update');
Route::get('/categories/delete/{id}', 'CategoryController@destroy');

// Usertype Routes
Route::get('/usertypes', 'UsertypeController@index');
Route::get('/usertypes/create', 'UsertypeController@create');
Route::post('/usertypes', 'UsertypeController@store');
Route::get('/usertypes/edit/{id}', 'UsertypeController@edit');
Route::patch('/usertypes/{id}', 'UsertypeController@update');
Route::get('/usertypes/delete/{id}', 'UsertypeController@destroy');
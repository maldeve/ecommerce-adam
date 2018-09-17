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

// User Routes
Route::get('/users', 'UserController@index');
Route::get('/users/delete/{id}', 'UserControlsler@destroy');

// Product Routes
Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::post('/products', 'ProductController@store');
Route::get('/products/edit/{id}', 'ProductController@edit');
Route::patch('/products/{id}', 'ProductController@update');
Route::get('/products/delete/{id}', 'ProductController@destroy');
Route::get('/products/add-to-cart/{id}', 'ProductController@addToCart');
Route::get('/products/shopping-cart', 'ProductController@shoppingCart');
Route::get('/checkout', 'ProductController@checkOut');
Route::post('/checkout', 'ProductController@postCheckOut');
Route::get('/products/user_orders', 'ProductController@getUserOrders');

// Feature Routes
Route::get('/features', 'FeatureController@index');
Route::get('/features/create', 'FeatureController@create');
Route::post('/features', 'FeatureController@store');
Route::get('/features/edit/{id}', 'FeatureController@edit');
Route::patch('/features/{id}', 'FeatureController@update');
Route::get('/features/delete/{id}', 'FeatureController@destroy');

// Product_Feature Routes
Route::get('/product_features/{product}', 'Product_FeatureController@productFeatures');
Route::post('/product_features', 'Product_FeatureController@store');
Route::patch('/product_features/{id}', 'Product_FeatureController@update');
Route::get('/product_features/{id}', 'Product_FeatureController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// layouts
Route::get('/layout', 'HomeController@layout');

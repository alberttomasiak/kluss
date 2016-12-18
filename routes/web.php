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

Auth::routes();
// home routes
Route::get('/home', 'HomeController@index');

// kluss routes
Route::get('/kluss_toevoegen', 'KlussController@index');
Route::post('/kluss/add', 'KlussController@add');

// test routes
Route::get('/send', 'EmailController@send');

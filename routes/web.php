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

Route::get('/login', function(){
    return view('auth/login')->with('title', 'Log in');
});

Route::get('/register', function(){
    return view('auth/register')->with('title', 'Registreer');
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});
// home routes
Route::get('/home', 'HomeController@index');

// kluss routes
Route::get('/kluss_toevoegen', 'KlussController@index');
Route::post('/kluss/add', 'KlussController@add');
Route::get('/kluss/{id}', 'KlussController@singleKluss');
// kluss solliciteren / bewerken routes
Route::get('/kluss/{id}/bewerken', 'KlussController@update');
Route::get('/kluss/{id}/solliciteren', 'KlussController@apply');
Route::post('/kluss/{id}/bewerken', 'KlussController@edit');

// profile routes
Route::get('/profiel/{id}', 'ProfielController@index');

// test routes
Route::get('/send', 'EmailController@send');

//Route::get('/chat', 'ChatController@getIndex')->middleware('chatusers');
Route::post('/chat/message', 'ChatController@postMessage')->middleware('chatusers');
Route::post('/chat/{id}', 'ChatController@requestChat');
Route::get('/chat/{chatname}', 'ChatController@startChatroom')->middleware('chatusers');

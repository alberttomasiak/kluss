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
    return redirect('/aanmelden');
});

Route::get('/aanmelden', function(){
    return view('auth/login')->with('title', 'Aanmelden');
});
Route::post('/aanmelden', 'UserController@login');

Route::get('/register', function(){
    return view('auth/register')->with('title', 'Registreer');
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::group(['middleware' => ['auth']], function(){
    // home routes
    Route::get('/home', 'HomeController@index');
    Route::post('/getTasks', 'HomeController@getTasks');
    // kluss routes
    Route::get('/kluss_toevoegen', 'KlussController@index');
    Route::post('/kluss/add', 'KlussController@add');
    Route::get('/kluss/{id}', 'KlussController@singleKluss');
    // kluss solliciteren / bewerken routes
    Route::get('/kluss/{id}/bewerken', 'KlussController@update');
    Route::get('/kluss/{id}/solliciteren', 'KlussController@apply');
    Route::post('/kluss/{id}/bewerken', 'KlussController@edit');
    // profile routes
    Route::get('/profiel/{id}/{name}', 'ProfielController@index');
    Route::post('/profiel/{id}/rapporteren', 'UserBlockController@blockUser');
    // test routes
    // Route::get('/send', 'EmailController@send');
    // Chat routes
    Route::get('/chat', 'ChatController@index');
    Route::post('/chat/message', 'ChatController@postMessage');
    // Route::post('/chat/{id}', 'ChatController@requestChat');
    // Route::get('/chat/{chatname}/{user}', 'ChatController@startChatroom')->middleware('chatusers');
    // // Chat testing routes
    // Route::get('/chat/overview','ChatController@overview');
    Route::post('/chat/{id}', 'ChatController@requestChat');
    Route::get('/chat/{chatname}/{user}', 'ChatController@startChat')->middleware('chatusers');
});

Route::group(['prefix' => 'admin'], function () {
    // Login route
    Route::get('/', function(){
        return redirect('/admin/dashboard');
    });
    Route::get('login', 'AdminController@index');
    Route::post('login', 'AdminController@login');
    Route::get('getData', 'AdminController@getData');
    Route::group(['middleware' => ['AdminAccess']], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        // Users
        Route::get('gebruikers/overzicht', 'AdminController@userOverview');
        Route::get('gebruikers/rapporteringen', 'AdminController@userReports');
        Route::get('gebruikers/blocks', 'AdminController@userBlocks');
        // Klusjes
        Route::get('klusjes/overzicht','AdminController@taskOverview');
        Route::get('klusjes/afgesloten','AdminController@taskClosed');
    });
});

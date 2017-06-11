<?php

use App\Mail\TestMail;

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

Route::get('/', function () { return view('welcome'); });
Auth::routes();
Route::get('/login', function(){ return redirect('/aanmelden'); });
Route::get('/aanmelden', function(){ return view('auth/login')->with('title', 'Aanmelden'); });
Route::post('/aanmelden', 'UserController@login');
Route::get('/register', function(){ return redirect('/registreren'); });
Route::get('/registreren', function(){ return view('auth/register')->with('title', 'Registreer'); });
Route::post('/registreren', 'UserController@register');
Route::get('/verificatie/{code}', 'UserController@verifyAccount');
Route::get('/verificatie_hersturen', 'UserController@verificationIndex');
Route::post('/verificatie_hersturen', 'UserController@resendVerification');

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

// test routes --> to be deleted

// end test routes

Route::group(['middleware' => ['auth']], function(){
    // home routes
    Route::get('/home', 'HomeController@index');
    // Ajax Routes
    Route::post('/getTasks', 'HomeController@getTasks');
    Route::post('/calculateDistance', 'KlussController@calculateUserDistance');
    // kluss routes
    Route::get('/kluss_toevoegen', 'KlussController@index');
    Route::post('/kluss/add', 'KlussController@add');
    Route::get('/kluss/{id}', 'KlussController@singleKluss');
    // kluss solliciteren / bewerken routes
    Route::get('/kluss/{id}/bewerken', 'KlussController@update');
    Route::get('/kluss/{id}/solliciteren', 'KlussController@apply');
    Route::post('/kluss/{id}/bewerken', 'KlussController@edit');
    Route::post('/kluss/{id}/sollicitant/{userid}/accepteren', 'KlussController@acceptUser');
    Route::post('/kluss/{id}/sollicitant/{userid}/weigeren', 'KlussController@refuseUser');
    Route::get('/kluss/{id}/verwijderen', 'KlussController@delete');
    // profile routes
    Route::get('/profiel/{id}/{name}', 'ProfielController@index');
    Route::post('/profiel/{id}/rapporteren', 'UserBlockController@blockUser');
    // Chat routes
    Route::get('/chat', 'ChatController@index');
    Route::post('/chat/message', 'ChatController@postMessage');
    Route::post('/chat/{id}', 'ChatController@requestChat');
    Route::get('/chat/{chatname}/{user}', 'ChatController@startChat')->middleware('chatusers');
    Route::get('/klussgold', 'KlussGoldController@index');
    Route::get('/bestel', 'KlussGoldController@bestel');
    Route::get('/review', 'ReviewController@index');
    // meldingen
    Route::get('/meldingen', 'HomeController@notificationsIndex');
    // Settings
    Route::get('/settings/persoonlijke_blocks', 'UserBlockController@index');
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
        Route::get('gebruikers', 'AdminController@userOverview');
        Route::get('gebruikers/overzicht', 'AdminController@userOverview');
        Route::get('gebruikers/rapporteringen', 'AdminController@userReports');
        Route::get('gebruikers/blocks', 'AdminController@userBlocks');
        Route::get('block/{id}/block', 'AdminController@blockUser');
        Route::get('block/{id}/unblock', 'AdminController@unblockUser');
        // Klusjes
        Route::get('klusjes', 'AdminController@taskOverview');
        Route::get('klusjes/overzicht','AdminController@taskOverview');
        Route::get('klusjes/afgesloten','AdminController@taskClosed');
        Route::get('klusje/{id}/goedkeuren', 'AdminController@approveTask');
        Route::post('klusje/{id}/afwijzen', 'AdminController@denyTask');
        // Settings
        Route::get('globale_instellingen', 'AdminController@settingsIndex');
        Route::post('setting/add', 'AdminController@settingsAdd');
        Route::post('setting/{id}/edit', 'AdminController@settingEdit');
        // meldingen
        Route::get('meldingen', 'AdminController@notificationsIndex');
        Route::post('notification/add', 'AdminController@sendGlobalNotification');
        Route::post('notify/user/{id}', 'AdminController@sendPersonalNotification');
    });
});

Route::get('/terms', function () {
    return view('/terms');
});

Route::get('/team', function () {
    return view('/team');
});

Route::get('/what', function () {
    return view('/what');
});

Route::get('/settings', function () {
    return view('settings.index');
});

Route::get('/FAQ', function () {
    return view('/FAQ');
});

Route::get('/community', function () {
    return view('/community');
});

Route::get('/landing', function () {
    return view('/landing');
});

Route::get('/plaatsklusje', function () {
    return view('/plaatsklusje');
});

Route::get('/userprofiel', function () {
    return view('/userprofiel');
});

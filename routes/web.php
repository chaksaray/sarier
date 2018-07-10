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
// OAuth Routes
Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
Route::get('auth/facebook/redirect', 'InstallAppController@handleRedirect');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/install', 'InstallAppController@installAppView');
Route::post('/install', 'InstallAppController@installApp');

//bot working uri
Route::get('/bot-get-way', 'Bot\BotController@botGetWay');

//Platform
Route::get('platform/dashboard','Platform\DashboardController@dashboardView');

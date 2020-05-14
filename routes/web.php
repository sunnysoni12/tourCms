<?php

use Illuminate\Support\Facades\Route;

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
Route::get('channelList', 'HomeController@index');
Route::get('showTour', 'HomeController@showTour');
Route::get('checkAvailabiliy', 'HomeController@checkAvailabiliy');
Route::get('startNewBooking', 'HomeController@startNewBooking');
Route::get('commitBooking', 'HomeController@commitBooking');

Route::get('searchBooking', 'HomeController@searchBooking');
Route::get('showBooking', 'HomeController@showBooking');






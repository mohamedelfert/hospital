<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::group(['middleware' => 'maintenance'], function () {
    Route::get('/', 'FrontController@home');

    Route::post('reservations', 'FrontController@reservation')->name('reservation');
    Route::get('doctors', 'FrontController@getDoctors')->name('doctors');
    Route::get('days', 'FrontController@getDays')->name('days');

    Route::get('reservation', 'FrontController@showReservation')->name('reservation.show');
    Route::get('about', 'FrontController@about')->name('about');
    Route::get('specialties', 'FrontController@specialties')->name('specialties');
    Route::get('doctors', 'FrontController@doctors')->name('doctors');
    Route::get('schedule', 'FrontController@schedule')->name('schedule');

    Route::get('find-doctor', 'FrontController@findDoctor')->name('findDoctor');
    Route::post('search', 'FrontController@search')->name('search');

    Route::get('/contact', 'FrontController@contact')->name('contact');
    Route::post('/add-contact', 'FrontController@addContact')->name('addContact');
});

Route::get('maintenance', function () {
    if (setting()->status === 'open') {
        return redirect('/');
    }
    return view('front/maintenance');
});

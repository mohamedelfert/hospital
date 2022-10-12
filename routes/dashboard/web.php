<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'auto_check_permission'])->group(function () {

        /**************************** Dashboard *******************************/
        Route::get('/index', 'DashboardController@index')->name('index');

        /**************************** Specialties *******************************/
        Route::resource('specialties', 'SpecialtyController');

        /**************************** Doctors *******************************/
        Route::resource('doctors', 'DoctorController');

        /**************************** Examinations *******************************/
        Route::resource('examinations', 'ExaminationController');

        /**************************** Examinations *******************************/
        Route::resource('workdays', 'WorkdayController');

        /**************************** List Price *******************************/
        Route::resource('prices', 'ListPriceController');

        /**************************** Reservations *******************************/
        Route::resource('reservations', 'ReservationController');
        Route::get('complete/{id}', 'ReservationController@complete')->name('complete');
        Route::get('doctor', 'ReservationController@getDoctors')->name('doctor');
        Route::get('day', 'ReservationController@getDays')->name('day');

        /**************************** Reservations *******************************/
        Route::resource('contacts', 'ContactController');

        /**************************** Users & Roles *******************************/
        Route::resource('users', 'UserController');
        Route::get('/users/profile/{id}', 'UserController@showProfile')->name('users.showProfile');
        Route::patch('/users/profile/{id}', 'UserController@profile')->name('users.profile');
        Route::resource('roles', 'RoleController');

        /**************************** Settings *******************************/
        Route::resource('settings', 'SettingController');

        Route::get('/{page}', function ($id) {
            if (view()->exists($id)) {
                return view($id);
            } else {
                return view('404');
            }
        });

    });

});

Route::get('/{page}', function ($id) {
    if (view()->exists($id)) {
        return view($id);
    } else {
        return view('404');
    }
});

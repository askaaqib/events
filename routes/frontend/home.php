<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'HomeController@index')->name('index');
Route::post('booking/calendarDates', 'HomeController@calendarDates')->name('calendarDates');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact/send', 'ContactController@send')->name('contact.send');
Route::get('check-bookings', 'HomeController@checkBookings')->name('check-bookings');
Route::get('get-reservation', 'HomeController@getReservation')->name('get-reservation');
Route::get('get-doc', 'HomeController@downloadForm')->name('get-doc');

//Route::get('get-reservation', 'HomeController@submitReservation')->name('get-reservation');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('eventdashboard', 'DashboardController@eventindex')->name('eventdashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});

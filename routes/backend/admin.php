<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('venues/create', 'VenuesContoller@create')->name('create');
Route::get('venues/edit/{id}', 'VenuesContoller@edit')->name('edit');
Route::post('venues/update', 'VenuesContoller@update')->name('update');
Route::get('venues/destroy/{id}', 'VenuesContoller@destroy')->name('destroy');
Route::resource('venues', 'VenuesContoller');
Route::post('events/create', 'EventsController@create')->name('create');
Route::get('events/edit/{id}', 'EventsController@edit')->name('edit');
Route::post('events/update', 'EventsController@update')->name('update');
Route::get('events/destroy/{id}', 'EventsController@destroy')->name('destroy');
Route::resource('events', 'EventsController');

Route::resource('bookings', 'BookingsController');
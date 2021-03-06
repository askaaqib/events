<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
// Route::post('venues/create', 'VenuesController@create')->name('create');
// Route::get('venues/edit/{id}', 'VenuesController@edit')->name('edit');
// Route::post('venues/update', 'VenuesController@update')->name('update');
Route::get('venues/destroy/{id}', 'VenuesController@destroy')->name('destroy');
Route::resource('venues', 'VenuesController');
Route::get('get-venue-capacity','VenuesController@getCapacity')->name('get-venue-capacity');
Route::post('events/create', 'EventsController@create')->name('create');
Route::get('events/edit/{id}', 'EventsController@edit')->name('edit');
Route::post('events/update', 'EventsController@update')->name('update');
Route::get('events/destroy/{id}', 'EventsController@destroy')->name('destroy');
Route::resource('events', 'EventsController');

Route::get('bookings/updatestatus/{id}', 'BookingsController@updateStatus')->name('updatestatus');
Route::get('bookings/edit/{id}', 'BookingsController@edit')->name('edit');
Route::post('bookings/update', 'BookingsController@update')->name('update');
Route::get('bookings/destroy/{id}', 'BookingsController@destroy')->name('destroy');
Route::resource('bookings', 'BookingsController');

Route::get('excludeDates/destroy/{id}', 'ExcludeDateController@destroy')->name('exccc.destroy');
Route::resource('excludeDates', 'ExcludeDateController');

Route::get('riseCapacity/destroy/{id}', 'RiseCapacityController@destroy')->name('destroy');
Route::resource('riseCapacity', 'RiseCapacityController');
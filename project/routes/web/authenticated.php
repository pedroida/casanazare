<?php

/**
 * Authenticated routes
 * Middleware 'auth'
 */

 /** Auth */
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/** Home */
Route::get('/', 'Admin\DashboardController@index')->name('dashboard.index');
Route::get('/home', 'Admin\DashboardController@index')->name('home');


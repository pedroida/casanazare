<?php

/**
 * Pagination routes for admin
 * Prefix 'admin', middleware 'auth:'web', 'auth', 'verified', 'user-type:ADMIN'
 * Name 'admin.'
 * Namespace 'App\Http\Controllers\Admin
 */

/** Users */
Route::get('admin-users', 'AdminUserController@pagination')->name('admin-users');
Route::get('voluntary-users', 'VoluntaryUserController@pagination')->name('voluntary-users');
Route::get('clients', 'ClientController@pagination')->name('clients');

Route::get('sources', 'SourceController@pagination')->name('sources');
Route::get('meals', 'MealController@pagination')->name('meals');
Route::get('stays', 'StayController@pagination')->name('stays');

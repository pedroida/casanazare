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
Route::get('forbidden-clients', 'ClientController@forbiddenPagination')->name('forbidden_clients');

Route::get('donations', 'DonationController@pagination')->name('donations');
Route::get('categories', 'CategoryController@pagination')->name('categories');
Route::get('units', 'UnitController@pagination')->name('units');
Route::get('sources', 'SourceController@pagination')->name('sources');
Route::get('meals', 'MealController@pagination')->name('meals');
Route::get('stays', 'StayController@pagination')->name('stays');

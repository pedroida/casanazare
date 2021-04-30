<?php

/**
 * Pagination routes for admin
 * Prefix 'admin', middleware 'auth:'web', 'auth', 'verified', 'user-type:ADMIN'
 * Name 'admin.'
 * Namespace 'App\Http\Controllers\Admin
 */

/** Users */
Route::get('clients', 'ClientController@pagination')->name('clients');
Route::get('forbidden-clients', 'ClientController@forbiddenPagination')->name('forbidden_clients');

Route::get('meals', 'MealController@pagination')->name('meals');
Route::get('stays', 'StayController@pagination')->name('stays');

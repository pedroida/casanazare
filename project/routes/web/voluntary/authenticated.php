<?php

use Illuminate\Support\Facades\Route;

/**
 * Authenticated routes for admin
 * Prefix 'admin', middleware 'auth:'web', 'auth', 'verified', 'user-type:ADMIN'
 * Name 'admin.'
 * Namespace 'App\Http\Controllers\Admin
 */

/** Profile */
Route::get('profile', 'ProfileController@index')->name('profile');
Route::put('profile', 'ProfileController@update')->name('profile.update');

/** System Routes */
Route::resource('acolhidos', 'ClientController');
Route::resource('estadias', 'StayController');
Route::post('estadias/planilha', 'StayController@import')->name('estadias.import-spreadsheet');
Route::resource('refeicoes', 'MealController')->except(['create', 'edit', 'show']);

Route::get('acolhidos-proibidos', 'ClientController@forbidden')->name('acolhidos.forbidden');

Route::get('/address/states', 'AddressController@getStatesJson')->name('states.json.all');
Route::get('/address/{abbr}/cities/', 'AddressController@getCitiesJsonFor')
    ->name('cities.state.json');
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
Route::resource('administradores', 'AdminUserController', ['parameters' => ['administradores' => 'id']]);
Route::resource('voluntarios', 'VoluntaryUserController', ['parameters' => ['voluntarios' => 'id']]);
Route::resource('doacoes', 'DonationController')->parameters(['doacoes' => 'donation'])->except(['show']);
Route::resource('categorias', 'CategoryController')
    ->parameters(['categorias' => 'category'])
    ->except(['show']);
Route::resource('unidades', 'UnitController')
    ->parameters(['unidades' => 'unit'])
    ->except(['show']);
Route::resource('acolhidos', 'ClientController');
Route::resource('estadias', 'StayController')->except(['show']);
Route::post('estadias/planilha', 'StayController@import')->name('estadias.import-spreadsheet');
Route::get('estadias/planilha-padrao', 'StayController@exportDefault')->name('estadias.export-default');
Route::resource('refeicoes', 'MealController')->except(['create', 'edit', 'show']);

Route::resource('origens', 'SourceController', ['parameters' => ['origens' => 'source']])->except(['show']);

Route::get('acolhidos-proibidos', 'ClientController@forbidden')->name('acolhidos.forbidden');

Route::get('/address/states', 'AddressController@getStatesJson')->name('states.json.all');
Route::get('/address/{abbr}/cities/', 'AddressController@getCitiesJsonFor')
    ->name('cities.state.json');
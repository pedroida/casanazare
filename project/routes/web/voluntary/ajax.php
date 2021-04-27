<?php

/**
 * Ajax routes for authenticated users.
 * Prefix 'ajax', middleware auth.
 */

Route::post('voluntary/{voluntary}/toggle-forbidden', 'ClientController@toggleForbidden')
    ->name('toggle.forbidden');

Route::post('dashboard/get-data', 'DashboardController@getData')->name('dashboard.get-data');
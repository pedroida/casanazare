<?php

/**
 * Ajax routes for authenticated users.
 * Prefix 'ajax', middleware auth.
 */

Route::post('client/{client}/toggle-forbidden', 'ClientController@toggleForbidden')
    ->name('toggle.forbidden');
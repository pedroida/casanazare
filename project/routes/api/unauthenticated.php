<?php

/**
 * Unauthenticated routes for Api
 * Prefix 'api/v1/voluntary'
 * Namespace 'App\Http\Controllers\Api\v1\Client'
 */

// Auth
Route::post('login', 'AuthController@login');

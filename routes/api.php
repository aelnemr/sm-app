<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '1.0',
    'as' => 'v1.',
    'namespace' => 'V1'
], function () {

    // auth
    Route::group([
        'namespace' => 'Auth',
        'prefix' => 'auth',
        'as' => 'auth.'
    ], function () {
        Route::post('login', 'LoginController@issueToken')->name('login');
    });

    Route::middleware('auth:api')->group(function () {

        // users
        Route::group(
            ['namespace' => 'User', 'prefix' => 'users', 'as' => 'users.'],
            base_path('routes/api/v1/user.php')
        );
    });

});

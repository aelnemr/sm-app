<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('media', '\App\Http\Controllers\UploadFileController@upload')
    ->middleware('auth:api')
    ->name('upload');


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
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegistrationController@register')->name('register');
    });

    // users
    Route::group(
        ['namespace' => 'User', 'prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'],
        base_path('routes/api/v1/user.php')
    );


//    // user messages
//    Route::group(
//        ['namespace' => 'Messages', 'prefix' => 'messages', 'as' => 'messages.', 'middleware' => 'auth'],
//        base_path('routes/api/v1/messages.php')
//    );

    Route::middleware('auth:api')->group(function () {



        // user feed
        Route::group(
            ['namespace' => 'Post', 'prefix' => 'feed', 'as' => 'feed.'],
            base_path('routes/api/v1/feed.php')
        );

        // user Post
        Route::group(
            ['namespace' => 'Post', 'prefix' => 'posts', 'as' => 'posts.'],
            base_path('routes/api/v1/post.php')
        );
    });

});

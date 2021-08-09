<?php

use Illuminate\Support\Facades\Route;

Route::post('/', 'PostController@store')->name('store');

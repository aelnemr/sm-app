<?php
use Illuminate\Support\Facades\Route;

Route::get('profile', 'UserController@profile')->name('profile');
//Route::get('/', 'UserController@index')->name('index');

<?php
use Illuminate\Support\Facades\Route;

Route::post('/', 'MessagesController@index')->name('index');
Route::post('/send', 'MessagesController@store')->name('send');

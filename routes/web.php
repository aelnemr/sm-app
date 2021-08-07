<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/api/1.0/users', [\App\Http\Controllers\API\V1\User\UserController::class, 'index'])->name('index');

Route::post('/api/1.0/messages/', [\App\Http\Controllers\API\V1\Messages\MessagesController::class, 'index'])->name('index');
Route::post('/api/1.0/messages/send', [\App\Http\Controllers\API\V1\Messages\MessagesController::class, 'store'])->name('send');



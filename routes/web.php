<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'register')->name('signup');

    Route::get('/forgot_password', 'forgot')
        ->middleware('guest')
        ->name('password.request');

    Route::get('/reset_password/{token}', 'reset')
        ->middleware('guest')
        ->name('password.reset');

    Route::post('forgot_password', 'forgotPassword')
        ->middleware('guest')
        ->name('password.email');

    Route::post('reset_password', 'resetPassword')
        ->middleware('guest')
        ->name('password.update');

    Route::post('/sign_in', 'signIn')->name('sign_in');
    Route::delete('/logout', 'logout')->name('logout');
    Route::post('/signup', 'store')->name('store');
});


<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'register')->name('signup');
    Route::get('/forgot_password', 'forgetPassword')->name('forgot_password');
    Route::get('/reset_password', 'resetPassword')->name('reset_password');
    Route::post('/sign_in', 'signIn')->name('sign_in');
    Route::delete('/logout', 'logout')->name('logout');
    Route::post('/signup', 'store')->name('store');
});

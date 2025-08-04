<?php

use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, 'getRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/root', [CommonController::class, 'root'])->name('root');
Route::get('/login', [AuthController::class, 'getLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

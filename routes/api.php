<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'authenticate'])->name('login');

Route::post('register', [RegisterController::class, 'register'])->name('register');

//Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('test', function () {
        return response('Testing auth route');
    });

    Route::post('logout', function () {
        Auth::guard('web')->logout();
    });

});

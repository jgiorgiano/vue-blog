<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'authenticate'])->name('login');

Route::post('register', [RegisterController::class, 'register'])->name('register');

//Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

/**
 * Email Confirmation Route
 */
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

Route::get('/email/send', [EmailVerificationController::class, 'send'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('article/published', [ArticleController::class, 'published']);
Route::get('article/featured', [ArticleController::class, 'featured']);

Route::get('article/{article}', [ArticleController::class, 'show']);

/**
 * Routes Authenticated without Email Confirmation
 */
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('test', function () {
        return response('Testing auth route');
    });

    Route::post('logout', function () {
        Auth::guard('web')->logout();
    });

    Route::get('user', [UserController::class, 'user']);
    Route::post('user', [UserController::class, 'update']);
});

/**
 * Routes Authenticated AND Email Confirmed
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::post('article', [ArticleController::class, 'store']);
    Route::get('article', [ArticleController::class, 'load']);
    Route::put('article/{article}', [ArticleController::class, 'update']);
    Route::put('article/{article}/manager', [ArticleController::class, 'manager']);
    Route::delete('article/{article}', [ArticleController::class, 'destroy']);

});


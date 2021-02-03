<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    /**
     * OPEN Routes
     */
    Route::post('login', [LoginController::class, 'authenticate'])->name('login');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

    Route::post('forgot-password', [ResetPasswordController::class, 'create'])
        ->middleware(['throttle:6,1'])->name('password.email');

    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->middleware(['throttle:6,1'])->name('password.reset');

    Route::prefix('article')->group(function() {
        Route::get('published', [ArticleController::class, 'published']);
        Route::get('featured', [ArticleController::class, 'featured']);
        Route::get('{article}', [ArticleController::class, 'show']);
    });


    /**
     * Routes Authenticated without Email Confirmation
     */
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('test', function () {
            return response('Testing auth route'); // Non testable
        });

        Route::get('email/send', [EmailVerificationController::class, 'send'])
            ->middleware(['throttle:6,1'])->name('verification.send');

        Route::post('logout', function () {
            Auth::guard('web')->logout();// tested OK
        });

        Route::prefix('user')->group(function() {
            Route::get('', [UserController::class, 'user']);
            Route::post('', [UserController::class, 'update']);
        });

    });


    /**
     * Routes Authenticated AND Email Confirmed
     */
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {

        Route::prefix('article')->group(function() {
            Route::post('', [ArticleController::class, 'store']);
            Route::get('', [ArticleController::class, 'index']);
            Route::put('{article}', [ArticleController::class, 'update']);
            Route::put('{article}/manager', [ArticleController::class, 'manager']);
            Route::delete('{article}', [ArticleController::class, 'destroy']);
        });

    });

});


<?php

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


//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//    return redirect('/');
//})->middleware(['auth', 'signed'])->name('verification.verify');
//
//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//
//    return back()->with('status', 'verification-link-sent');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/**
 * Routes Authenticated without Email Confirmation
 */
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', function () {
        Auth::guard('web')->logout();
    });

    Route::get('user', function () {
        return Auth::user();
    });

    Route::post('user', [UserController::class, 'update']);

});

/**
 * Routes Authenticated AND Email Confirmed
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('test', function () {
        return response('Testing auth route');
    });

});


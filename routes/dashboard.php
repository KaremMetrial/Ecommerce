<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    Auth\LoginController,
    Auth\PasswordController,
    Home\HomeController
};
// ================= Dashboard Routes =================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {
// ================== Auth Routes ==================
    Route::prefix('login')->middleware(['guest:admin'])->controller(LoginController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('/', 'authenticate')->name('authenticate');
    });
    Route::prefix('reset-password')->middleware(['guest:admin'])->name('password.')->controller(PasswordController::class)->group(function () {
        Route::get('/', 'requestPasswordReset')->name('request');
        Route::post('/', 'sendPasswordResetOtp')->name('email');

        Route::prefix('confirm')->name('confirm.')->group(function () {
            Route::get('/', 'confirmPasswordReset')->name('index');
            Route::post('/', 'confirmPasswordResetPost')->name('post');
        });
        Route::prefix('reset')->name('reset.')->group(function () {
            Route::get('/', 'resetPasswordForm')->name('index');
            Route::post('/', 'resetPassword')->name('post');
        });
    });

// ================= Protected Routes =================
    Route::middleware('auth:admin')->group(function () {
// ================= Dashboard Home =================
        Route::get('/', HomeController::class)->name('dashboard');

// ================= Logout =================
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

});

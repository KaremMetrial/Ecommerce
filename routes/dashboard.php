<?php

use App\Http\Controllers\Dashboard\Home\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\LoginController;

// ================= Dashboard Routes =================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {
// ================== Auth Routes ==================
    Route::prefix('login')->middleware('guest')->controller(LoginController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('/', 'authenticate')->name('authenticate');
    });
// ================= Protected Routes =================
    Route::middleware('auth:admin')->group(function () {
// ================= Dashboard Home =================
        Route::get('/', HomeController::class)->name('dashboard');
    });

});

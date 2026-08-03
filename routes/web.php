<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard redirect
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Root redirect
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Advertiser routes (placeholder for next iteration)
Route::middleware(['auth', 'role:advertiser'])->prefix('advertiser')->name('advertiser.')->group(function () {
    Route::get('/offers', fn() => 'Advertiser offers coming soon')->name('offers.index');
});

// Webmaster routes (placeholder for next iteration)
Route::middleware(['auth', 'role:webmaster'])->prefix('webmaster')->name('webmaster.')->group(function () {
    Route::get('/subscriptions', fn() => 'Webmaster subscriptions coming soon')->name('subscriptions.index');
});

// Admin routes (placeholder for next iteration)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => 'Admin dashboard coming soon')->name('dashboard');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MooraDemoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FishController;

// Redirect root to auth page
Route::get('/', fn() => redirect('/auth'));
Route::get('/auth', [AuthController::class, 'show'])->name('auth.show');


// Public auth routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('auth.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Google OAuth routes 
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/fish/{id}', [FishController::class, 'show'])->name('user.fish_detail');
});

// Public about page
Route::get('/about-us', fn() => view('about-us'))->name('about-us');

// Admin routes protected by auth + admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/foods', [AdminController::class, 'foodIndex'])->name('admin.foods.index');
    Route::get('/fishes', [AdminController::class, 'fishIndex'])->name('admin.fishes.index');
    Route::get('/user-results', [AdminController::class, 'resultIndex'])->name('admin.user-results.index');
    Route::get('/varieties', [AdminController::class, 'varietyIndex'])->name('admin.varieties.index');

    Route::post('/food/create', [AdminController::class, 'storeFood'])->name('admin.food.store');
    Route::put('/food/{id}', [AdminController::class, 'updateFood'])->name('admin.food.update');
    Route::put('/food/{id}/soft-delete', [AdminController::class, 'softDeleteFood'])->name('admin.food.softDelete');
    Route::put('/food/{id}/recover', [AdminController::class, 'recoverFood'])->name('admin.food.recover');

    Route::post('/ikan/create', [AdminController::class, 'storeIkan'])->name('admin.ikan.store');
    Route::put('/ikan/{id}', [AdminController::class, 'updateIkan'])->name('admin.ikan.update');
    Route::put('/ikan/{id}/soft-delete', [AdminController::class, 'softDeleteIkan'])->name('admin.ikan.softDelete');
    Route::put('/ikan/{id}/recover', [AdminController::class, 'recoverIkan'])->name('admin.ikan.recover');
    Route::put('/ikan/{id}/verify', [AdminController::class, 'verifyIkan'])->name('admin.ikan.verify');

    Route::post('/varieties/create', [AdminController::class, 'storeVariety'])->name('admin.varieties.store');
    Route::put('/varieties/{id}', [AdminController::class, 'updateVariety'])->name('admin.varieties.update');
    Route::put('/varieties/{id}/soft-delete', [AdminController::class, 'softDeleteVariety'])->name('admin.varieties.softDelete');
    Route::put('/varieties/{id}/recover', [AdminController::class, 'recoverVariety'])->name('admin.varieties.recover');
});


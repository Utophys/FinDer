<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MooraDemoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FishController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;



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
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/fish/{id}', [FishController::class, 'show'])->name('user.fish_detail');

    Route::post('/send-password-reset-link', [PasswordResetController::class, 'sendCustomResetLink'])->name('user.reset_password_send');
  
    Route::get('/dss', function () {
        // Pastikan file 'kuesioner.blade.php' ada di resources/views/
        return view('user.dss');
    })->name('user.dss');
    Route::post('/dss/store-result', [MooraDemoController::class, 'storeResult'])->name('user.dss.storeResult');
    Route::get('/dss/results/{result_id}', [MooraDemoController::class, 'show'])->name('user.dss.showResult');
});

// Public about page
Route::get('/about-us', fn() => view('about-us'))->name('about-us');

Route::get('/moorademo', [MooraDemoController::class, 'index'])->name('moorademo');
Route::post('/moorademo/store', [MooraDemoController::class, 'storeResult'])->name('moorademo.store');

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

    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

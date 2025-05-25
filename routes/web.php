<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MooraDemoController;
use Illuminate\Support\Facades\Route;

// default route
Route::get('/', function () {
    return redirect('/auth');
});
Route::get('/auth', [AuthController::class, 'show'])->name('auth.show');

// homepage route
Route::get('/homepage', function () {
    return view('user.homepage');
})->middleware('auth');

//kai cenat
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// login register
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//about-us
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/moorademo', [MooraDemoController::class, 'index'])->name('moorademo');
Route::post('/moorademo/store', [MooraDemoController::class, 'storeResult'])->name('moorademo.store');


Route::get('/admin/foods', [AdminController::class, 'foodIndex'])->name('admin.foods.index');
Route::get('/admin/fishes', [AdminController::class, 'fishIndex'])->name('admin.fishes.index');
Route::get('/admin/user-results', [AdminController::class, 'resultIndex'])->name('admin.user-results.index');
Route::get('/admin/varieties', [AdminController::class, 'varietyIndex'])->name('admin.varieties.index');


Route::post('/admin/food/create', [AdminController::class, 'storeFood'])->name('admin.food.store');
Route::put('/admin/food/{id}', [AdminController::class, 'updateFood'])->name('admin.food.update');
Route::put('/admin/food/{id}/soft-delete', [AdminController::class, 'softDeleteFood'])->name('admin.food.softDelete');
Route::put('/admin/food/{id}/recover', [AdminController::class, 'recoverFood'])->name('admin.food.recover');


Route::post('/admin/ikan/create', [AdminController::class, 'storeIkan'])->name('admin.ikan.store');
Route::put('/admin/ikan/{id}', [AdminController::class, 'updateIkan'])->name('admin.ikan.update');
Route::put('/admin/ikan/{id}/soft-delete', [AdminController::class, 'softDeleteIkan'])->name('admin.ikan.softDelete');
Route::put('/admin/ikan/{id}/recover', [AdminController::class, 'recoverIkan'])->name('admin.ikan.recover');
Route::put('/admin/ikan/{id}/verify', [AdminController::class, 'verifyIkan'])->name('admin.ikan.verify');


Route::post('/admin/varieties/create', [AdminController::class, 'storeVariety'])->name('admin.varieties.store');
Route::put('/admin/varieties/{id}', [AdminController::class, 'updateVariety'])->name('admin.varieties.update');
Route::put('/admin/varieties/{id}/soft-delete', [AdminController::class, 'softDeleteVariety'])->name('admin.varieties.softDelete');
Route::put('/admin/varieties/{id}/recover', [AdminController::class, 'recoverVariety'])->name('admin.varieties.recover');

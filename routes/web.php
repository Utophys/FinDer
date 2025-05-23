<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//kai cenat
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// login register
Route::middleware(['guest'])->group(function () {
    Route::get('/auth', [AuthController::class, 'show'])->name('auth.show');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});



Route::get('/admin/foods', [AdminController::class, 'foodIndex'])->name('admin.foods.index');
Route::get('/admin/fishes', [AdminController::class, 'fishIndex'])->name('admin.fishes.index');
Route::get('/admin/user-results', [AdminController::class, 'resultIndex'])->name('admin.user-results.index');


Route::post('/admin/food/create', [AdminController::class, 'storeFood'])->name('admin.food.store');
Route::put('/admin/food/{id}', [AdminController::class, 'updateFood'])->name('admin.food.update');
Route::put('/admin/food/{id}/soft-delete', [AdminController::class, 'softDeleteFood'])->name('admin.food.softDelete');
Route::put('/admin/food/{id}/recover', [AdminController::class, 'recoverFood'])->name('admin.food.recover');


Route::post('/admin/ikan/create', [AdminController::class, 'storeIkan'])->name('admin.ikan.store');
Route::put('/admin/ikan/{id}', [AdminController::class, 'updateIkan'])->name('admin.ikan.update');
Route::put('/admin/ikan/{id}/soft-delete', [AdminController::class, 'softDeleteIkan'])->name('admin.ikan.softDelete');
Route::put('/admin/ikan/{id}/recover', [AdminController::class, 'recoverIkan'])->name('admin.ikan.recover');
Route::put('/admin/ikan/{id}/verify', [AdminController::class, 'verifyIkan'])->name('admin.ikan.verify');


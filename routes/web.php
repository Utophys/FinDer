<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([])->group(function () {
    Route::get('/login', function () {
        return view('login_register');
    });
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


Route::post('/admin/food', [AdminController::class, 'storeFood'])->name('admin.food.store');
Route::put('/admin/food/{id}', [AdminController::class, 'updateFood'])->name('admin.food.update');
Route::put('/admin/food/{id}/soft-delete', [AdminController::class, 'softDeleteFood'])->name('admin.food.softDelete');
Route::put('/admin/food/{id}/recover', [AdminController::class, 'recoverFood'])->name('admin.food.recover');


Route::post('/admin/ikan', [AdminController::class, 'storeIkan'])->name('admin.ikan.store');
Route::put('/admin/ikan/{id}', [AdminController::class, 'updateIkan'])->name('admin.ikan.update');
Route::put('/admin/ikan/{id}/soft-delete', [AdminController::class, 'softDeleteIkan'])->name('admin.ikan.softDelete');
Route::put('/admin/ikan/{id}/recover', [AdminController::class, 'recoverIkan'])->name('admin.ikan.recover');

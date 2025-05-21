<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// ========================
// 📦 Routes untuk FOOD
// ========================
Route::post('/admin/food', [AdminController::class, 'storeFood'])->name('admin.food.store');
Route::put('/admin/food/{id}', [AdminController::class, 'updateFood'])->name('admin.food.update');
Route::delete('/admin/food/{id}', [AdminController::class, 'deleteFood'])->name('admin.food.delete');

// =============================
// 🐟 Routes untuk AlternativeFish
// =============================
Route::post('/admin/ikan', [AdminController::class, 'storeIkan'])->name('admin.ikan.store');
Route::put('/admin/ikan/{id}', [AdminController::class, 'updateIkan'])->name('admin.ikan.update');
Route::delete('/admin/ikan/{id}', [AdminController::class, 'deleteIkan'])->name('admin.ikan.delete');
Route::delete('/admin/ikan/{id}/soft-delete', [AdminController::class, 'softDeleteIkan'])->name('admin.ikan.softDelete');

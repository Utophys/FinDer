<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Route::post('/logout', function () {
//     auth()->logout();
//     return redirect('/auth');
// })->name('logout')->middleware('auth');




Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


Route::post('/admin/food', [AdminController::class, 'storeFood'])->name('admin.food.store');
Route::put('/admin/food/{id}', [AdminController::class, 'updateFood'])->name('admin.food.update');
Route::put('/admin/food/{id}/soft-delete', [AdminController::class, 'softDeleteFood'])->name('admin.food.softDelete');
Route::put('/admin/food/{id}/recover', [AdminController::class, 'recoverFood'])->name('admin.food.recover');


Route::post('/admin/ikan', [AdminController::class, 'storeIkan'])->name('admin.ikan.store');
Route::put('/admin/ikan/{id}', [AdminController::class, 'updateIkan'])->name('admin.ikan.update');
Route::put('/admin/ikan/{id}/soft-delete', [AdminController::class, 'softDeleteIkan'])->name('admin.ikan.softDelete');
Route::put('/admin/ikan/{id}/recover', [AdminController::class, 'recoverIkan'])->name('admin.ikan.recover');
Route::put('/admin/ikan/{id}/verify', [AdminController::class, 'verifyIkan'])->name('admin.ikan.verify');

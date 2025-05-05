<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return view('public.welcome');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Admin - Aktuality
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/aktuality', [NewsController::class, 'index'])->name('news');
    Route::get('/aktuality/{id}', [NewsController::class, 'show'])->name('news.show');
    Route::post('/aktuality', [NewsController::class, 'store'])->name('news.store');
    Route::get('/aktuality-create', [NewsController::class, 'create'])->name('news.create');
    Route::delete('/aktuality-delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
    Route::get('/aktuality-edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/aktuality/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::post('/aktuality-publish/{id}', [NewsController::class, 'publish'])->name('news.publish');
    Route::delete('/aktuality-image-delete/{id}', [NewsController::class, 'deleteImage'])->name('news.image.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

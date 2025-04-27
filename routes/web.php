<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Aktuality
Route::get('/aktuality', [NewsController::class, 'index'])->middleware(['auth', 'verified'])->name('news');
Route::get('/aktuality/{id}', [NewsController::class, 'show'])->middleware(['auth', 'verified'])->name('news.show');
Route::post('/aktuality', [NewsController::class, 'store'])->middleware(['auth', 'verified'])->name('news.store');
Route::get('/aktuality-create', [NewsController::class, 'create'])->middleware(['auth', 'verified'])->name('news.create');
Route::delete('/aktuality-delete/{id}', [NewsController::class, 'delete'])->middleware(['auth', 'verified'])->name('news.delete');
Route::get('/aktuality-edit/{id}', [NewsController::class, 'edit'])->middleware(['auth', 'verified'])->name('news.edit');
Route::put('/aktuality/{id}', [NewsController::class, 'update'])->middleware(['auth', 'verified'])->name('news.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

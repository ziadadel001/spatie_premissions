<?php

use App\Http\Controllers\permissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    //* permissions routes for showlist and create one
    Route::get('/permissions', [permissionController::class, 'index'])->name('permission.index');
    Route::get('/permissions/create', [permissionController::class, 'create'])->name('permission.create');
    Route::post('/permissions', [permissionController::class, 'store'])->name('permission.store');

    //* permissions routes for edit and update 
    Route::get('/permissions/{id}/edit', [permissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/{id}', [permissionController::class, 'update'])->name('permission.update');
});

require __DIR__ . '/auth.php';

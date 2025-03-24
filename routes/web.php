<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

    //* permissions routes for destroy
    Route::delete('/permissions', [permissionController::class, 'destroy'])->name('permission.destroy');




    //* roles routes for showlist and create one
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('role.store');

    //* Roles routes for edit and update 
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('role.update');

    //* Roles routes for destroy
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('role.destroy');



    //* articles routes for showlist and create one
    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('article.store');

    //* articles routes for edit and update 
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/articles/{id}', [ArticleController::class, 'update'])->name('article.update');

    //* articles routes for destroy
    Route::delete('/articles', [ArticleController::class, 'destroy'])->name('article.destroy');
});

require __DIR__ . '/auth.php';

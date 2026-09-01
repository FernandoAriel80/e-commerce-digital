<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/panel-administrativo', fn() => view('pages.admin.dashboard-general'))->name('dashboard.general');
    Route::get('/panel-usuarios', [AdminController::class, 'panelUsers'])->name('dashboard.user');
    Route::get('/panel-usuarios-busqueda', [AdminController::class, 'panelUsersSearch'])->name('dashboard.user.search');

    Route::get('/panel-categorias', [CategoryController::class, 'index'])->name('dashboard.category');

    Route::get('/panel-create-categorias', fn() => view('pages.admin.category.create-category'))->name('category.create');
    Route::post('/panel-create-categorias', [CategoryController::class, 'create'])->name('category.create.post');
    Route::get('/panel-update-categorias/{id}', [CategoryController::class, 'updateView'])->name('category.update.get');
    Route::put('/panel-update-categorias/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/panel-delete-categorias/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});

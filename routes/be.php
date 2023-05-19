<?php

use App\Http\Controllers\Admin\AccountProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminAccountMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware([AdminAccountMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('account')->group(function () {
        Route::get('/profile', [AccountProfileController::class, 'index'])->name('admin.account.profile');

    });

    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('admin.category.list');
        Route::get('add', [CategoryController::class, 'add'])->name('admin.category.add');
        Route::get('list', [CategoryController::class, 'list'])->name('admin.category.list');
        Route::get('list', [CategoryController::class, 'list'])->name('admin.category.list');
    });
});
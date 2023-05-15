<?php

use App\Http\Controllers\Admin\AccountProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminAccountMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware([AdminAccountMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/account-profile', [AccountProfileController::class, 'index'])->name('admin.account-profile');
});
<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminAccountMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware([AdminAccountMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

});
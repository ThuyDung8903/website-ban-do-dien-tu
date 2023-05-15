<?php

use App\Http\Controllers\Admin\AdminAccountController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function (){
    Route::get('/login', [AdminAccountController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminAccountController::class, 'post_login']);
    Route::get('/logout', [AdminAccountController::class, 'logout'])->name('admin.logout');
});
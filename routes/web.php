<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/be.php';

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('home');
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


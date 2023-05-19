<?php
//<!--Route for front end-->
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/collections', [FrontendController::class, 'categories'])->name('collections.categories');
Route::get('/collections/{category_slug}', [FrontendController::class, 'products'])->name('collections.products');
Route::get('/collections/{category_slug}/{product_slug}', [FrontendController::class, 'productView'])->name('collection.product.view');



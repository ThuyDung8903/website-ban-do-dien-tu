<?php
//<!--Route for front end-->
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories'])->name('collections.categories');
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products'])->name('collections.products');
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView'])->name('collection.product.view');



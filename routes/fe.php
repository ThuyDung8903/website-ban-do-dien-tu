<?php
//<!--Route for front end-->
Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories'])->name('collections.categories');
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products'])->name('collections.category-slug.products');
Route::get('/collections/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'productsByCategoryId'])->name('collections.category-id.products');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

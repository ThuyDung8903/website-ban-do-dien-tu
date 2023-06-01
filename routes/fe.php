<?php
//<!--Route for front end-->
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;

//Route groups for authenticated customers only
Route::group(['middleware' => ['guest:customer']], function () {
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');

    Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

    Route::get('/password/reset', [CustomerAuthController::class, 'showLinkRequestForm'])->name('customer.password.request');
    Route::post('/password/email', [CustomerAuthController::class, 'sendResetLinkEmail'])->name('customer.password.email');

    Route::get('/password/reset/{token}', [CustomerAuthController::class, 'showResetPasswordForm'])->name('customer.password.reset');
    Route::post('/password/reset', [CustomerAuthController::class, 'reset'])->name('customer.password.update');
});

//Route groups for customer logout
Route::group(['middleware' => ['auth:customer']], function () {
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
});

//Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
//Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
//Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.register');
//Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');
//Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/collections', [FrontendController::class, 'categories'])->name('collections.categories');
Route::get('/collections/{category_slug}', [FrontendController::class, 'products'])->name('collections.products');
Route::get('/collections/{category_slug}/{product_slug}', [FrontendController::class, 'productView'])->name('collection.product.view');

Route::get('/new-arrivals', [FrontendController::class, 'newArrivals'])->name('new-arrivals');

Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('auth.customer');
Route::get('/cart', [\App\Http\Controllers\Frontend\CartController::class, 'index'])->middleware('auth.customer');
Route::get('/checkout', [\App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->middleware('auth.customer');
Route::get('/orders', [\App\Http\Controllers\Frontend\OrderController::class, 'index'])->middleware('auth.customer');
Route::get('/orders/{order_id}', [\App\Http\Controllers\Frontend\OrderController::class, 'show'])->middleware('auth.customer');

Route::get('thank-you', [FrontendController::class, 'thankYou'])->name('thank-you');


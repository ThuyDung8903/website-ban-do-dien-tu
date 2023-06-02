<?php

use App\Http\Controllers\Admin\AccountProfileController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminAccountMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware([AdminAccountMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('account')->group(function () {
        Route::get('/profile', [AccountProfileController::class, 'index'])->name('admin.account.profile');
        Route::post('/upload-avatar', [AccountProfileController::class, 'upload'])->name('admin.account.upload-avatar');
        Route::post('/do-edit/user{id}', [AccountProfileController::class, 'doEdit'])->name('admin.account.do-edit-user');

    });
    Route::prefix('user')->group(function () {
        Route::get('list', [UserController::class, 'list'])->name('admin.user.list');
        Route::get('add', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('do-add', [UserController::class, 'doAdd'])->name('admin.user.do-add');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('do-edit/{id}', [UserController::class, 'doEdit'])->name('admin.user.do-edit');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::post('/upload-avatar/user-{id}', [UserController::class, 'upload'])->name('admin.user.upload-avatar');
    });
    Route::prefix('customer')->group(function () {
        Route::get('list', [CustomerController::class, 'list'])->name('admin.customer.list');
        Route::get('add', [CustomerController::class, 'add'])->name('admin.customer.add');
        Route::post('do-add', [CustomerController::class, 'doAdd'])->name('admin.customer.do-add');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::post('do-edit/{id}', [CustomerController::class, 'doEdit'])->name('admin.customer.do-edit');
        Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
        Route::post('/upload-avatar/customer-{id}', [CustomerController::class, 'upload'])->name('admin.customer.upload-avatar');
    });
    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('admin.category.list');
        Route::get('add', [CategoryController::class, 'add'])->name('admin.category.add');
        Route::post('do-add', [CategoryController::class, 'doAdd'])->name('admin.category.do-add');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('do-edit/{id}', [CategoryController::class, 'doEdit'])->name('admin.category.do-edit');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });
    Route::prefix('banner')->group(function () {
        Route::get('list', [BannerController::class, 'list'])->name('admin.banner.list');
        Route::get('add', [BannerController::class, 'add'])->name('admin.banner.add');
        Route::post('do-add', [BannerController::class, 'doAdd'])->name('admin.banner.do-add');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('admin.banner.edit');
        Route::post('do-edit/{id}', [BannerController::class, 'doEdit'])->name('admin.banner.do-edit');
        Route::get('delete/{id}', [BannerController::class, 'delete'])->name('admin.banner.delete');
    });
    Route::prefix('brand')->group(function () {
        Route::get('list', [BrandController::class, 'list'])->name('admin.brand.list');
        Route::get('add', [BrandController::class, 'add'])->name('admin.brand.add');
        Route::post('do-add', [BrandController::class, 'doAdd'])->name('admin.brand.do-add');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::post('do-edit/{id}', [BrandController::class, 'doEdit'])->name('admin.brand.do-edit');
        Route::get('delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
    });
    Route::prefix('payment-method')->group(function () {
        Route::get('list', [PaymentMethodController::class, 'list'])->name('admin.payment-method.list');
        Route::get('add', [PaymentMethodController::class, 'add'])->name('admin.payment-method.add');
        Route::post('do-add', [PaymentMethodController::class, 'doAdd'])->name('admin.payment-method.do-add');
        Route::get('edit/{id}', [PaymentMethodController::class, 'edit'])->name('admin.payment-method.edit');
        Route::post('do-edit/{id}', [PaymentMethodController::class, 'doEdit'])->name('admin.payment-method.do-edit');
        Route::get('delete/{id}', [PaymentMethodController::class, 'delete'])->name('admin.payment-method.delete');
    });
    Route::prefix('shipping-method')->group(function () {
        Route::get('list', [ShippingMethodController::class, 'list'])->name('admin.shipping-method.list');
        Route::get('add', [ShippingMethodController::class, 'add'])->name('admin.shipping-method.add');
        Route::post('do-add', [ShippingMethodController::class, 'doAdd'])->name('admin.shipping-method.do-add');
        Route::get('edit/{id}', [ShippingMethodController::class, 'edit'])->name('admin.shipping-method.edit');
        Route::post('do-edit/{id}', [ShippingMethodController::class, 'doEdit'])->name('admin.shipping-method.do-edit');
        Route::get('delete/{id}', [ShippingMethodController::class, 'delete'])->name('admin.shipping-method.delete');
    });
    Route::prefix('order-status')->group(function () {
        Route::get('list', [OrderStatusController::class, 'list'])->name('admin.order-status.list');
        Route::get('add', [OrderStatusController::class, 'add'])->name('admin.order-status.add');
        Route::post('do-add', [OrderStatusController::class, 'doAdd'])->name('admin.order-status.do-add');
        Route::get('edit/{id}', [OrderStatusController::class, 'edit'])->name('admin.order-status.edit');
        Route::post('do-edit/{id}', [OrderStatusController::class, 'doEdit'])->name('admin.order-status.do-edit');
        Route::get('delete/{id}', [OrderStatusController::class, 'delete'])->name('admin.order-status.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('list', [ProductController::class, 'list'])->name('admin.product.list');
        Route::get('add', [ProductController::class, 'add'])->name('admin.product.add');
        Route::post('do-add', [ProductController::class, 'doAdd'])->name('admin.product.do-add');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('do-edit/{id}', [ProductController::class, 'doEdit'])->name('admin.product.do-edit');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('/delete-image/{id}', [ProductController::class, 'deleteImage'])->name('admin.product.delete-image');
//        Route::get('product-detail', [ProductController::class, 'view_detail'])->name('admin.product.product-detail');
    });

    Route::prefix('order')->group(function () {
        Route::get('list', [OrderController::class, 'index'])->name('admin.order.list');
        Route::put('update-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('admin.order.update-status');
        Route::get('invoice/{id}', [OrderController::class, 'invoice'])->name('admin.order.invoice');
        Route::get('view-invoice/{id}', [OrderController::class, 'viewInvoice'])->name('admin.order.view-invoice');
        Route::get('invoice/generate/{id}', [OrderController::class, 'generateInvoice'])->name('admin.order.invoice-generate');
    });

});
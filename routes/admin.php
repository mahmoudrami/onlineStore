<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ServiceController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::prefix(LaravelLocalization::setLocale())->group(function () {
Route::prefix('admin/')->name('admin.')->group(function () {

    require __DIR__ . '/authAdmin.php';
    // admin add for

    Route::middleware(['is_admin', 'has_permission'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('homePage');

        Route::resource('user', UserController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('coupon', CouponController::class);
        Route::resource('order', OrderController::class);
        Route::resource('role', RoleController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('language', LanguageController::class);
        Route::resource('review', ReviewController::class);
        Route::resource('attribute', AttributeController::class);

        Route::post('changeStatus/{model}', [HomeController::class, 'changeStatus'])->name('changeStatus');
        Route::post('product/delete-image/{id?}', [ProductController::class, 'delete_image'])->name('product.delete_image');
    });
});
// });
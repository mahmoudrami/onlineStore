<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supplier\HomeController;
use App\Http\Controllers\Supplier\OrderController;
use App\Http\Controllers\Supplier\ProductController;
use App\Http\Controllers\Supplier\ReviewController;

// Route::prefix(LaravelLocalization::setLocale())->group(function () {
Route::prefix('supplier/')->name('supplier.')->group(function () {

    require __DIR__ . '/authSupplier.php';
    // supplier add for

    Route::middleware(['is_supplier'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('homePage');

        Route::resource('product', ProductController::class);
        Route::resource('order', OrderController::class);
        Route::resource('order', ReviewController::class);

        Route::post('changeStatus/{model}', [HomeController::class, 'changeStatus'])->name('changeStatus');
        Route::post('product/delete-image/{id?}', [ProductController::class, 'delete_image'])->name('product.delete_image');
    });
});
// });
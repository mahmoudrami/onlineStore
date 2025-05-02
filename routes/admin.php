<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin/')->name('admin.')->group(function () {

    require __DIR__ . '/authAdmin.php';
    // admin add for

    Route::middleware(['is_admin', 'has_permission'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('homePage');

        Route::resource('product', ProductController::class);
        Route::post('product/delete-image/{id?}', [ProductController::class, 'delete_image'])->name('product.delete_image');
        Route::post('changeStatus/{model}', [HomeController::class, 'changeStatus'])->name('changeStatus');
        Route::resource('category', CategoryController::class);
    });
});

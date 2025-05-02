<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/')->name('admin.')->group(function () {

    require __DIR__ . '/auth.php';

    Route::get('/', [HomeController::class, 'index'])->name('homePage');

    Route::resource('product', ProductController::class);
    Route::post('product/delete-image/{id?}', [ProductController::class, 'delete_image'])->name('product.delete_image');
});

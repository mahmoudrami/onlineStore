<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\BankController;
use App\Http\Controllers\Site\FrontController;
use App\Http\Controllers\Site\PaymentController;



Route::get('/', [FrontController::class, 'index'])->name('homePage');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // website Route

});


Route::get('cart/{id}', [FrontController::class, 'addItemToCart']);
require __DIR__ . '/auth.php';

Route::get('payment/{id}', [FrontController::class, 'payment'])->name('payment');
Route::get('callBackUrl', [PaymentController::class, 'callBackUrl'])->name('callBackUrl');
Route::get('errorUrl', [PaymentController::class, 'errorUrl'])->name('errorUrl');


// use Illuminate\Support\Facades\Broadcast;

// Broadcast::routes(['middleware' => ['web', 'auth']]);

Route::get('test', [FrontController::class, 'test']);
Route::get('categories', [FrontController::class, 'categories'])->name('categories');
Route::get('category', [FrontController::class, 'category'])->name('category');
Route::get('product', [FrontController::class, 'product'])->name('product');

Route::get('cart', [frontController::class, 'cart'])->name('cart');

Route::get('profile', [FrontController::class, 'profile'])->name('profile');
Route::get('edit-password', [FrontController::class, 'editPassword'])->name('editPassword');

Route::get('place-order', [FrontController::class, 'placeOrder']);

Route::middleware('auth')->group(function () {
    Route::get('userWishlist', [FrontController::class, 'userWishlist'])->name('userWishlist');
});




Route::get('bank', [BankController::class, 'bank'])->name('bank');
Route::get('money', [BankController::class, 'money'])->name('money');

Route::get('formAddMoney', [BankController::class, 'formAddMoney'])->name('formAddMoney');
Route::post('addMoney/{id}', [BankController::class, 'addMoney'])->name('addMoney');

Route::get('formEditMoney/{id}', [BankController::class, 'formEditMoney'])->name('formEditMoney');
Route::put('editMoney/{id}', [BankController::class, 'editMoney'])->name('editMoney');

Route::get('formAddBank', [BankController::class, 'formAddBank'])->name('formAddBank');
Route::post('addBank', [BankController::class, 'addBank'])->name('addBank');

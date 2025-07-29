<?php

use App\Http\Controllers\Auth\LoginSocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\BankController;
use App\Http\Controllers\Site\FrontController;
use App\Http\Controllers\Site\PaymentController;



Route::get('/', [FrontController::class, 'index'])->name('homePage');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     // website Route

// });


Route::get('cart/{id}', [FrontController::class, 'addItemToCart']);
require __DIR__ . '/auth.php';



// use Illuminate\Support\Facades\Broadcast;

// Broadcast::routes(['middleware' => ['web', 'auth']]);

Route::get('test', [FrontController::class, 'test']);
Route::get('categories', [FrontController::class, 'categories'])->name('categories');
Route::get('category/{id}', [FrontController::class, 'category'])->name('category');
Route::get('product/{product}', [FrontController::class, 'product'])->name('product');

Route::get('auth/{provider}/redirect', [LoginSocialiteController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [LoginSocialiteController::class, 'callback'])->name('auth.socialite.callback');



Route::get('test', [FrontController::class, 'test']);


Route::middleware('auth')->group(function () {
    Route::get('userWishlist', [FrontController::class, 'userWishlist'])->name('userWishlist');
    Route::get('cart', [frontController::class, 'cart'])->name('cart');
    Route::post('cityDiscount', [frontController::class, 'cityDiscount'])->name('cityDiscount');
    Route::post('addItemToCart/{id?}', [frontController::class, 'addToItemCart'])->name('addItemToCart');
    Route::post('deleteItemsFromCart', [frontController::class, 'deleteItemsFromCart'])->name('deleteItemsFromCart');
    Route::post('updateCart/{id}', [frontController::class, 'updateCart'])->name('updateCart');
    Route::post('ItemToWishlist/{id?}', [frontController::class, 'ItemToWishlist'])->name('ItemToWishlist');
    Route::get('place-order', [FrontController::class, 'placeOrder'])->name('placeOrder');
    Route::post('place-order', [FrontController::class, 'savePlaceOrder'])->name('savePlaceOrder');
    Route::get('profile', [FrontController::class, 'profile'])->name('profile');
    Route::post('profile', [FrontController::class, 'editProfile'])->name('editProfile');
    Route::delete('delete-account', [FrontController::class, 'deleteAccount'])->name('deleteAccount')->middleware('password.confirm');
    Route::get('cart/{cart}/payment', [PaymentController::class, 'create'])->name('checkout-payment'); // payment gateway
    Route::post('payment', [PaymentController::class, 'store'])->name('payment'); // payment gateway
    Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    Route::post('review/{id}', [FrontController::class, 'review'])->name('review');
    // Route::get('review', [FrontController::class, 'reviewStore']);
    Route::get('edit-password', [FrontController::class, 'editPassword'])->name('editPassword');
    Route::get('checkPassword', [FrontController::class, 'checkPassword'])->name('checkPassword');
    Route::post('edit-password', [FrontController::class, 'editPasswordStore'])->name('password');
});

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [FrontController::class, 'showForgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [FrontController::class, 'forgotPassword']);
    Route::post('/verify-code', [FrontController::class, 'verifyCode'])->name('verifyCode');
    Route::get('reset-password', [FrontController::class, 'showResetPassword'])->name('resetPassword');
    Route::post('/reset-password', [FrontController::class, 'resetPassword']);
});

Route::post('/translate', [FrontController::class, 'translateText'])->name('translate.text');
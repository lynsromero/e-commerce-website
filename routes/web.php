<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPanel\ProfileController;
use App\Http\Controllers\UserPanel\UserLoginController;
use App\Http\Controllers\UserPanel\UserRegisterController;



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('shop', 'shop')->name('shop');
});


Route::get('admin/login', function () {
    return view('admin-panel.login');
})->name('login');




Route::get('product-detail', function () {
    return view('product-detail');
})->name('product.detail');


Route::get('testimonial', function () {
    return view('testimonial');
})->name('testimonial');


Route::get('checkout', function () {
    return view('checkout');
})->name('checkout');


Route::get('contact', function () {
    return view('contact');
})->name('contact');



Route::controller(UserLoginController::class)->group(function () {
    Route::get('user/login', 'showLoginForm')->name('user.login');
    Route::post('user/login',  'login');
});

Route::controller(UserRegisterController::class)->group(function () {
    Route::get('user/register',  'showRegisterForm')->name('user.register');

    Route::post('user/register', 'register')->name('user.store');
});


Route::middleware('auth.role:2,3')->group(function () {
    Route::controller(CartController::class)->group(function(){
        Route::get('cart', 'cart')->name('cart');
        Route::get('add/cart', 'addCart')->name('add.cart');
        Route::get('cart/update', 'updateCart')->name('update.cart');
        Route::get('cart/remove',  'removeCart')->name('remove.cart');
        Route::get('total/payout', 'totalPayout')->name('total.payout');
    });
});


Route::get('admin/register', [RegisterController::class, 'create'])->name('admin.register');

Route::post('admin/store', [RegisterController::class, 'register'])->name('admin.store');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');





Route::middleware('auth')->group(function () {
    Route::get('user/list', [UserController::class, 'index'])->name('users.list');



    Route::prefix('products')->group(function () {
        Route::controller(ProductController::class)->group(function () {

            Route::get('list', 'index')->name('products.list');
            Route::get('create', 'create')->name('product.create');
            Route::post('store', 'store')->name('product.store');
            Route::get('edit/{id}', 'edit')->name('product.edit');
            Route::get('delete/{id}', 'delete')->name('product.delete');
            Route::post('update/{id}', 'update')->name('product.update');
        });
    });


    Route::get('dashboard', function () {
        return view('admin-panel.dashboard');
    })->name('dashboard');
});

Route::get('product-detail/{id}', [ProductController::class, 'show'])->name('product-detail');
Route::get('profile', [ProfileController::class, 'index'])->name(name: 'profile');
Route::get('logout', [UserLoginController::class, 'logout'])->name('user.logout');


Route::middleware('auth.role:2,3')->group(function () {
    Route::get('checkout', [CheckoutController::class , 'checkout'])->name('checkout');
    Route::controller(StripePaymentController::class)->group(function () {
    Route::get('/payment-confirmation', 'index')->name('stripe.index');
    Route::post('/stripe', 'store')->name('stripe.store');
});
});



<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('admin/login', function () {
    return view('admin-panel.login');
})->name('login');








Route::get('shop', function () {
    return view('shop');
})->name('shop');

Route::get('product-detail', function () {
    return view('product-detail');
})->name('product.detail');

Route::get('cart', function () {
    return view('cart');
})->name('cart');

Route::get('testimonial', function () {
    return view('testimonial');
})->name('testimonial');


Route::get('chackout', function () {
    return view('chackout');
})->name('chackout');


Route::get('contact', function () {
    return view('contact');
})->name('contact');





Route::get('admin/register', [RegisterController::class, 'create'])->name('admin.register');
Route::post('admin/store', [RegisterController::class, 'register'])->name('admin.store');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');





Route::middleware('auth')->group(function () {
    Route::get('user/list', [UserController::class, 'index'])->name('users.list');



    Route::prefix('products')->group(function(){
        Route::controller(ProductController::class)->group(function(){

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

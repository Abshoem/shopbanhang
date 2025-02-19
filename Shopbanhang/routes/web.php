<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\RateController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware([AuthMiddleware::class])->group(function () {


    Route::get('products/admin', [ProductController::class, 'admin'])->name('products.admin');
    Route::get('products/showdetail2/{id}', [ProductController::class, 'showdetail2'])->name('products.showdetail2');
    Route::get('products/{id}/buy', [ProductController::class, 'buy'])->name('products.buy');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::resource('products', ProductController::class);
    // Các route chỉ dành cho admin
    Route::middleware([AuthMiddleware::class])->group(function () {
        Route::get('/categories/{categoryId}/create/product', [CategoryController::class, 'createProduct'])->name('categories.createProduct');
        Route::resource('categories', CategoryController::class);
        Route::get('categories/{categoryId}/showProducts', [CategoryController::class, 'showProducts'])->name('categories.showProducts');
        Route::post('/categories/{categoryId}/products', [CategoryController::class, 'storeProduct'])->name('categories.storeProduct');

    });

    Route::get('/user', [UserController::class, 'index']);

    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // chuc nang addtoCart
    Route::get('products/{id}/buy-products', [ProductController::class, 'buyAndRedirectToProducts'])->name('products.buy.products');


});

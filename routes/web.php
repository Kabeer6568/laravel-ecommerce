<?php

use Illuminate\Support\Facades\Route;
use App\Http\COntrollers\ProductController;
use App\Http\COntrollers\OrderController;
use App\Http\COntrollers\AuthController;

Route::get('/', [ProductController:: class, 'viewProducts'])->defaults('page' , 'home')->name('products.data');

Route::get('/product-list', [ProductController:: class, 'viewProducts'])->defaults('page' , 'list')->name('products.list');

Route::get('/product/{product:slug}', [ProductController:: class, 'show'])->name('products.show');

Route::post('/add-to-cart', [ProductController:: class, 'addToCart'])->name('products.addToCart');
Route::get('/add-to-cart', [ProductController:: class, 'cart'])->name('products.showCart');

Route::post('/cart/update', [ProductController:: class, 'updateCart'])->name('products.updateCart');



Route::get('checkout', [OrderController:: class, 'checkout'])->name('products.checkout');
Route::post('checkout', [OrderController:: class, 'placeOrder'])->name('products.placeOrder');

Route::get('/clear-cart', function() {
    session()->forget('cart');
    return redirect()->back()->with('success', 'Cart cleared!');
})->name('cart.clear');
Route::get('/contact', function () {
    return view('layouts/contact');
})->name('product.contact');

Route::get('/login', [AuthController::class , 'create'])->name('product.create');
Route::post('/login', [AuthController::class , 'login'])->name('admin.login');


Route::get('/dash', [AuthController::class , 'dash'])->middleware('auth')->name('admin.dash');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\COntrollers\ProductController;

Route::get('/', [ProductController:: class, 'viewProducts'])->defaults('page' , 'home')->name('products.data');

Route::get('/product-list', [ProductController:: class, 'viewProducts'])->defaults('page' , 'list')->name('products.list');

Route::get('/product/{product:slug}', [ProductController:: class, 'show'])->name('products.show');

Route::post('/add-to-cart', [ProductController:: class, 'addToCart'])->name('products.addToCart');
Route::get('/add-to-cart', [ProductController:: class, 'cart'])->name('products.showCart');


Route::get('/clear-cart', function() {
    session()->forget('cart');
    return redirect()->back()->with('success', 'Cart cleared!');
})->name('cart.clear');
Route::get('/contact', function () {
    return view('layouts/contact');
});

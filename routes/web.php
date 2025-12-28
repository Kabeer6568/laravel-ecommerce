<?php

use Illuminate\Support\Facades\Route;
use App\Http\COntrollers\ProductController;

Route::get('/', [ProductController:: class, 'viewProducts'])->defaults('page' , 'home')->name('products.data');
Route::get('/product-list', [ProductController:: class, 'viewProducts'])->defaults('page' , 'list')->name('products.list');

Route::get('/contact', function () {
    return view('layouts/contact');
});

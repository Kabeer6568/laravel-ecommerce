<?php

use Illuminate\Support\Facades\Route;
use App\Http\COntrollers\ProductController;

Route::get('/', [ProductController:: class, 'viewProducts'])->name('products.data');
Route::get('/contact', function () {
    return view('layouts/contact');
});

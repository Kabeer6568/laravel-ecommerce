<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function viewProducts(){

        $products = Product::get();

        return view('layouts/index' , compact('products'));

    }
}

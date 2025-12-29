<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function viewProducts($page = 'list'){

        $products = Product::paginate(15);

        $viewPath = ($page === 'home') ? 'layouts/index' : 'layouts/product-list';

        return view($viewPath , compact('products'));

    }
}

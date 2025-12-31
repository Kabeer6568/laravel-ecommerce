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

    public function show($slug){

        $product = Product::where('slug' , $slug)->firstOrFail();

        return view('layouts/product-details' , compact('product'));

    }

    public function addToCart(Request $request){

        $product_id =$request->input('product_id');

        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart' , []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]++;
        }
        else{
            $cart[$product_id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('products.showCart');

    }

    public function cart(){

        $cart = session('cart' , []);
        $total = 0;

        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('layouts.cart' , compact('cart' , 'total'));

    }
}

<?php


namespace App\Services;

use App\Models\Product;

class ProductService{

    public function showAll(){

        $uniProducts = Product::latest()->paginate(8);

        return $uniProducts;

    }
    

}
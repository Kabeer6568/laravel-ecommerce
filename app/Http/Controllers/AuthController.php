<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create(){

        $user = auth()->user();

        return view('layouts.login'  , compact('user'));

    }

    public function login(Request $request){

        $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $loginData = filter_var($request->login , FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = ([

            $loginData => $request->login,
            'password' => $request->password,

        ]);

        if (AUTH::attempt($credentials)) {
            return redirect()->route('admin.dash')->with('sucess' , 'Logged In');
        }
        else{
            return back()->withError([
                'login' => 'Username/Email or Password is incorrect'
            ])->onlyOutput('login');
        }

    }

    public function dash(){

        $products = Product::paginate(10);

        return view('layouts.admin.index' , compact('products'));

    }

    public function addProductPage(){

        return view('layouts.admin.add-products');

    }

    public function addProduct(Request $request){

        $pData = $request->validate([

        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'price' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_featured' => 'required|in:1,0',

        ]);

        if ($request->hasFile('image')) {
            $pData['image'] = $request->file('image')->store('products' , 'public');
        }

        Product::create($pData);

        return redirect()->route('admin.dash')->with('sucess' , 'Product Uploaded');

    }

    public function logout(Request $request){

        AUTH::logout();

        $request->session()->invalidate();

        return redirect()->route('products.data')->with('success' , 'You have been logged out');

    }

    public function updateProductPage($id){

        $product = Product::findOrFail($id);

        return view('layouts.admin.update-product' , compact('product'));

    }

    public function updateProduct(Request $request , $id){

        $data = $request->validate([

        'name' => 'nullable|string|max:255',
        'slug' => 'nullable|string|max:255',
        'price' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_featured' => 'nullable|in:1,0',

        ]);

        $product = Product::findOrFail($id);

        if ($request->filled('name')) {
            $product['name'] = $data['name'];
        }
        if ($request->filled('slug')) {
            $product['slug'] = $data['slug'];
        }
        
        if ($request->filled('price')) {
            $product['price'] = $data['price'];
        }
        if ($request->filled('description')) {
            $product['description'] = $data['description'];
        }
        if ($request->hasFile('image')) {

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('profiles' , 'public');
            $product->image = $path;
        }
        if ($request->has('is_featured')) {
            $product['is_featured'] = $data['is_featured'];
        }

        $product->save();

        return redirect()->route('admin.dash')->with('success' , 'Blog Updated');
    }

    public function delete($id){

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dash')->with('success' , 'Prodeuct deleted');

    }
}

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
}

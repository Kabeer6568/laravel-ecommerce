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

    public function showProducts(){

        $products = Product::paginate(10);

        return view('layouts.admin.index' , compact('products'));

    }
}

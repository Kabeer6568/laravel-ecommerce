<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(){

        $cart = session('cart' , []);

        $total = 0;
        $shipping = '$200';
        
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
            
            if($total > 2000){
                $shipping = 'Free';
                $grandTotal = $total;
            }
            else{
                
                $shipping = '$200';
                $grandTotal = $total;
            }
        }

        return view('layouts.checkout' , compact('cart' , 'total' , 'shipping' , 'grandTotal'));

    }

    public function placeOrder(Request $request){

        $validated = $request->validate([
            
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',            
            'payment_method' => 'required|in:Cash_on_Delivery,Direct_Bank_Transfer,Check_Payment,Paypal',

        ]);

        $cart = session('cart' , []);

        $total = 0;
        $shipping = 200;

        foreach($cart as $item){
            
            if($total > 2000){
                $shipping = 'Free';
                $total += $item['price'] * $item['quantity'];
            }
            else{
                $total = $item['price'] * $item['quantity'] + $shipping;
            }

        }

        $order = Order::create([

            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone_no' => $validated['phone_no'],
            'address' => $validated['address'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zipcode' => $validated['zipcode'], 
            'total_amount' => $total,
            'status' => 'processing',           
            'payment_method' => $validated['payment_method'],
            
        ]);


        foreach ($cart as $productId => $item){
            OrderItem::create([
            'order_id' => $order->id,
            'product_id'=> $productId,
            'product_name' =>$item['name'],
            'price' => $item['price'], 
            'quantity' => $item['quantity'],
            ]);
        };

        session()->forget('cart');

        return redirect()->route('products.data')->with('success' , 'Order placed');

    }
}

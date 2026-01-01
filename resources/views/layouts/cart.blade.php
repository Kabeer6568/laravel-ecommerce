@extends('layouts.app')


@section('content')
        
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        
        <!-- Cart Start -->

        @if (empty($cart))
            <p>
                Your Cart is empty
            </p>
        @else
        <div class="cart-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="align-middle">
                                    @foreach ($cart as $id=>$item)
                                    <tr>
                                        <td><a href="#"><img src="img/product-1.png" alt="Image"></a></td>
                                        <td><a href="#">{{$item['name']}}</a></td>
                                        <td id="product_price" data-product-price = "{{$item['price']}}">{{$item['price']}}</td>
                                        <td>
                                            <div class="qty" id="product_info" data-product-id="{{$id}}">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" id="product_qty" data-product-qty = "{{$item['quantity']}}" value="{{$item['quantity']}}">
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="subtotal">{{number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td><button><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="coupon">
                            <input type="text" placeholder="Coupon Code">
                            <button>Apply Code</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-summary">
                            <div class="cart-content">
                                <h3>Cart Summary</h3>
                                <p>Sub Total<span>${{ number_format($total, 2) }}</span></p>
                                <p>Shipping Cost<span>$1</span></p>
                                <h4>Grand Total<span>${{ number_format($total, 2) }}</span></h4>
                            </div>
                            <div class="cart-btn">
                                <button>Update Cart</button>
                                <button>Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
        
        
        @endsection
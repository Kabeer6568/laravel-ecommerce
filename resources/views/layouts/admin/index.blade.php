@extends('layouts.app')


@section('content')

<div class="cart-page">
            <div class="container">
                <div class="row" style="margin: 25px 0px;">
                    <div class="col-md-6">
                        <div class="cart-summary">
                            
                            <div class="cart-btn">
                                <button>
                                <a href="{{ route('admin.addProduct') }}">
                                    Add new product
                                </a>
                                </button>

                                <button>
                                    <a href="{{ route('logout') }}">
                                        Logout
                                    </a>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Slug</th>
                                        <th>Price</th>
                                        <th>Featured</th>
                                        <th>Edit</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="align-middle">
                                    @foreach($products as $product)
                                    <tr>
                                        <td><a href="#">{{$product->id}}</a></td>
                                        <td><a href="#"><img src="{{$product->image}}" alt="Image"></a></td>
                                        
                                        <td><a href="#">{{ucfirst($product->name)}}</a></td>
                                        <td>{{$product->slug}}</td>
                                        <td>
                                            ${{$product->price}}
                                        </td>
                                        <td class="">
                                            @if($product->is_featured === 1)
                                            Yes
                                            @else
                                            No
                                            
                                            @endif
                                        </td>
                                        
                                        <td><button>
                                            <a href="{{ route('admin.updateProduct' , $product->id) }}">
                                               <i class="fa fa-file"> </i>
                                            </a>
                                        </button></td>
                                        <td><button><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="col-lg-12">
                            {{ $products->links('layouts.pagination.custom-paginate') }}

                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="cart-summary">
                            
                            <div class="cart-btn">
                                <button>
                                <a href="{{ route('cart.clear') }}">
                                    Clear Cart
                                </a>
                                </button>
                                <button>
                                    <a href="{{ route('products.checkout') }}">
                                        Checkout
                                    </a>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
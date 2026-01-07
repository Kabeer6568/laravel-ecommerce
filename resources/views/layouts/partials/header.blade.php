<!-- Top Header Start -->
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <input type="text" placeholder="Search">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>
                                <div class="dropdown-menu">
                                    <a href="{{route('product.create')}}" class="dropdown-item">Login</a>
                                    <a href="#" class="dropdown-item">Register</a>
                                </div>
                            </div>
                            <div class="cart">
                                <a href="{{route('products.addToCart')}}">
                                <i class="fa fa-cart-plus "></i>
                                </a>
                                <span class="product-count">
                                @php    
                                $cart = session('cart' , []);
                                $count = array_sum(array_column($cart , 'quantity'));
                                echo $count;
                                @endphp
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Header End -->
        
        
        <!-- Header Start -->
        <div class="header">
            <div class="container">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav m-auto">
                            <a href="{{route('products.data')}}" class="nav-item nav-link active">Home</a>
                            <a href="{{route('products.list')}}" class="nav-item nav-link">Products</a>
                            <a href="{{route('products.showCart')}}" class="nav-item nav-link">Product Cart</a>
                            <a href="{{route('products.checkout')}}" class="nav-item nav-link">Checkout</a>
                            <a href="{{route('product.contact')}}" class="nav-item nav-link">Contact Us</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header End -->
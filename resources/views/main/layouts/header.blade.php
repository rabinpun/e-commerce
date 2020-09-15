
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
						<option>¥ JPY</option>
						<option>$ USD</option>
						<option>€ EUR</option>
					</select>
                    </div>
                    <div class="our-link " style="margin-right:0">
                        <ul>
                            @auth
                            <li><a href="/home">My Account</a></li>
                            @endauth
                            <li><p style="color: white">Call US : <a href="tel:9845902604">9845902604</a></p></li>
                            @guest
                            <li><a href="/login">Log In</a></li>
                            <li><a href="/register">Register</a></li>
                            @endguest
                            @auth
                            
                        <li><form action="{{route('logout')}}" method="POST">@csrf<button style="border:none;font-size:1.1rem;background-color: black;color:white" type="submit">Log Out</button></form></li>
                            
                            
                            @endauth
                           
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="{{route('main.index')}}"><img src="{{asset('frontend_assets/images/logo.png')}}" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                   {{-- {{menu('menu','admin.menus')}}  <!--using the menu feature of the voyager we can update name order and routes of the menu from the admin panel   --> --}}
                   <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{route('main.index')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                    <li class="dropdown megamenu-fw">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu megamenu-content" role="menu">
                            <li>
                                <div class="row">
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Top</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="shop.html">Jackets</a></li>
                                                <li><a href="shop.html">Shirts</a></li>
                                                <li><a href="shop.html">Sweaters & Cardigans</a></li>
                                                <li><a href="shop.html">T-shirts</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Bottom</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="shop.html">Swimwear</a></li>
                                                <li><a href="shop.html">Skirts</a></li>
                                                <li><a href="shop.html">Jeans</a></li>
                                                <li><a href="shop.html">Trousers</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Clothing</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="shop.html">Top Wear</a></li>
                                                <li><a href="shop.html">Party wear</a></li>
                                                <li><a href="shop.html">Bottom Wear</a></li>
                                                <li><a href="shop.html">Indian Wear</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Accessories</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="shop.html">Bags</a></li>
                                                <li><a href="shop.html">Sunglasses</a></li>
                                                <li><a href="shop.html">Fragrances</a></li>
                                                <li><a href="shop.html">Wallets</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                </div>
                                <!-- end row -->
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('products.index')}}" class="nav-link dropdown-toggle" data-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('cart.index')}}">Cart</a></li>
                            <li><a href="{{route('checkout.index')}}">Checkout</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="shop-detail.html">Shop Detail</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="service.html">Our Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.html">Contact Us</a></li>
                </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu"><a href="#">
						<i class="fa fa-shopping-bag" style="color:blue;transform: scale(2);position:relative"></i>
                        @if(Cart::instance('default')->count()>0)
                        <span  style="position: absolute"><h2 class="cart-count" style="text-align:center;height:20px;width:20px;color:white;left:10px;top:-10px">{{Cart::count()}}</h2></span>
                        @endif
                    </a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        @foreach(Cart::content() as $product)
                        <li>
                            <a href="#" class="photo"><img src="{{asset('storage/'.$product->model->image)}}" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">{{$product->model->name}} </a></h6>
                            <p>{{$product->qty}}x - <span class="price">Rs {{$product->model->price}}</span></p>
                        </li>
                        @endforeach
                        <li class="total">
                            <a href="{{route('cart.index')}}" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: Rs {{Cart::subtotal()}}</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <form action="{{route('search')}}" method="GET">
                     <input type="text" class="form-control" name="search" placeholder="{{request()->search}}"> {{--if you put request()->search without quotes string with space will print only the words before space 'ram is good' will be 'ram' only --}}
                </form>
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    
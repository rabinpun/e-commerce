
<ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
    @foreach($items as $menu_item)
    @if ($menu_item->title == 'Home')
   
    <li class="nav-item active"><a class="nav-link" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endif
    @endforeach
            
    
    @foreach($items as $menu_item)
    @if ($menu_item->title == 'About')
   
    <li class="nav-item"><a class="nav-link" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endif
    @endforeach
   
    <li class="dropdown megamenu-fw">
        @foreach($items as $menu_item)
        @if ($menu_item->title == 'Product')
        <a href="{{ $menu_item->link() }}" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $menu_item->title }}</a>
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
                </div> 
                    <!-- end col-3 -->
                
                <!-- end row -->
               
            </li>
        </ul>
        @endif
        @endforeach
        
        
    </li>
    <li class="dropdown">
        @foreach($items as $menu_item)
        @if ($menu_item->title == 'Shop')
   
    
        <a href="{{ $menu_item->link() }}" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $menu_item->title }}</a>
        @endif
        @endforeach
        <ul class="dropdown-menu">
            @foreach($items as $menu_item)
            @if ($menu_item->title == 'Cart')
    <li><a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endif
    @endforeach
            
            <li><a href="checkout.html">Checkout</a></li>
            <li><a href="my-account.html">My Account</a></li>
            <li><a href="wishlist.html">Wishlist</a></li>
            <li><a href="shop-detail.html">Shop Detail</a></li>
        </ul>
    </li>
    @foreach($items as $menu_item)
            @if ($menu_item->title == 'Our Service')
  
    <li class="nav-item"><a class="nav-link" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endif
    @endforeach
    @foreach($items as $menu_item)
            @if ($menu_item->title == 'Contact Us')
   
    <li class="nav-item"  style="margin-right:7rem"><a class="nav-link" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endif
    @endforeach

    @guest
    
    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Log In</a></li>
    <li class="nav-item"><a class="nav-link" href="{{route('register') }}">Sign Up</a></li>
    @else
    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a></li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endguest
    
    
    
</ul> 
    



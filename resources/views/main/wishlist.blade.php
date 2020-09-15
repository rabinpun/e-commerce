@extends('main.layouts.master')

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">wishlist</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                @if(session()->has('success_message'))
                        <div class="alert alert-success">{{session('success_message')}}</div>
                @endif
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                       <div class="alert alert-danger"><li>{{$error}}</li></div> 
                    @endforeach
                @endif
                @if(count($products)>0)
                <h2><strong>{{count($products)}} item(s) in Wishlist</strong></h2>
               
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Remove</th>
                                
                            </tr>
                        </thead>
                        @foreach ($products as $product)

                        
                        <tbody>
                            
                                
                            
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="{{route('products.show',$product->slug)}}">
                                    <img class="img-fluid" src="{{ asset('storage/'.$product->image) }}" alt="" />
                            </a>
                                </td>
                                <td class="name-pr">
                                <a href="{{route('products.show',$product->slug)}}">
                                {{$product->name}}
                            </a>
                                </td>
                                <td class="price-pr">
                                    <p>Rs {{$product->price}}</p>
                                </td>
                                
                                 
                    
                                

                                </select></td>

                                
                                <td class="price-pr">
                                <form action="{{route('wishlist.delete',$product->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                 <i class="fas fa-times" style="position: relative"><button type="submit" class="btn" style="position:absolute;top:0;left:0;opacity:0"></button></i>
                                </form>
                            </a>
                                </td>
                            </tr>
                            
                        </tbody>
                        @endforeach
                    </table>
                </div>
               
                
            </div>
        </div>

        <div class="row my-5">
            @if (!session()->has('usedcoupon'))
                
            
            {{-- <div class="col-lg-6 col-sm-6">
                <div class="coupon-box">
                <form action="{{route('coupons.store')}}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input class="form-control" placeholder="Enter your coupon code" name="coupon_code" aria-label="Coupon code" type="text">
                        <div class="input-group-append">
                            <button class="btn btn-theme" type="submit">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                </div>
            </div> --}}
            @endif
            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <a href="/products" class="btn hvr-hover" style="color: white ">Continue Shopping</a>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                {{-- <div class="order-box">
                    <h3>Order summary</h3>
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold">Rs {{Cart::subtotal()}}</div>
                    </div>
                    
                    <hr class="my-1">
                    <div class="d-flex">
                        <div>
                         @if (session()->has('usedcoupon'))
                        <h4>Coupon Discount ({{session()->get('usedcoupon')['name']}})</h4>
                        <form action="{{route('coupons.delete')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border:none;"><i class="fas fa-trash-alt"></button></i></button>
                            </form>
                            @endif 
                        </div>
                            
                        
                       
                    
                        <div class="ml-auto font-weight-bold">
                            @if (session()->has('usedcoupon'))
                            Rs {{session()->get('usedcoupon')['discount']}}
                        @endif</div>
                    </div>
                    @if(session()->has('usedcoupon'))
                    <div class="d-flex">
                        <h4>New Subtotal: </h4>
                        <div class="ml-auto font-weight-bold">Rs {{$newsubtotal}} </div>
                    </div>
                    @endif
                    <div class="d-flex">
                        <h4>Vat: 13%</h4>
                        <div class="ml-auto font-weight-bold">Rs {{$newtax}} </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> Rs {{$newtotal}}</div>
                    </div>
                    <hr> </div> --}}
            </div>
            {{-- <div class="col-12 d-flex shopping-box"><a href="{{route('checkoutcod.index')}}" class="ml-auto btn hvr-hover">Cash on Delivery</a>
                
                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                    <input value="{{$newtotal}}" name="tAmt" type="hidden">
                    <input value="{{$newsubtotal}}" name="amt" type="hidden">
                    <input value="{{$newtax}}" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="epay_payment" name="scd" type="hidden">
                    <input value="{{rand(1,999999999999)}}" name="pid" type="hidden">
                    <input value="http://127.0.0.1:8000/checkoutes" type="hidden" name="su">
                    <input value="http://127.0.0.1:8000/failpay" type="hidden" name="fu">
                    <a ><button style="margin-left:5rem;color:white;height:3.2rem;font-size:1.1rem" class="ml-auto btn hvr-hover" type="submit"> Pay with esewa</button></a>
                    </form>
                
                <a href="{{route('checkout.index')}}" class="ml-auto btn hvr-hover">Checkout with Card</a> </div>
        </div> --}}
        @else 
        <h2><strong> No items in Wishlist!</strong><br><a href="/products" class="btn hvr-hover" style="color: white ">Continue Shopping</a></h2>
         @endif
        <hr>
        

    </div>
</div>
<!-- End Cart -->
    
@endsection

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
                    <li class="breadcrumb-item active">Cart</li>
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
                @if(Cart::count()>0)
                <h2><strong>{{Cart::count()}} item(s) in Shopping Cart</strong></h2>
               
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                                <th>Save for later</th>
                            </tr>
                        </thead>
                        @foreach (Cart::content() as $product)

                        
                        <tbody>
                            
                                
                            
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="{{route('products.show',$product->model->slug)}}">
                                    <img class="img-fluid" src="{{ asset('storage/'.$product->model->image) }}" alt="" />
                            </a>
                                </td>
                                <td class="name-pr">
                                <a href="{{route('products.show',$product->model->slug)}}">
                                {{$product->model->name}}
                            </a>
                                </td>
                                <td class="price-pr">
                                    <p>Rs {{$product->model->price}}</p>
                                </td>
                            <td class="quantity-box"><select class="quantity" item-id="{{$product->rowId}}">
                                @for ($i = 1; $i <= 5; $i++)
                            <option {{ $product->qty == $i ? 'selected':''}}>{{$i}}</option>    
                                @endfor       
                    
                                

                                </select></td>
                                <td class="total-pr">
                                    <p>Rs {{$product->subtotal()}}</p>
                                </td>
                                
                                <td class="remove-pr">
                                <form action="{{route('cart.delete',$product->rowId)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                 <i class="fas fa-times" style="position: relative"><button type="submit" class="btn" style="position:absolute;top:0;left:0;opacity:0"></button></i>
                                </form>
                            </a>
                                </td>
                                <td>
                                <form action="{{route('cart.saveforlater',$product->rowId)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Save For Later</button>
                                </form>
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
                
            
            <div class="col-lg-6 col-sm-6">
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
            </div>
            @endif
            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <input value="Update Cart" type="submit">
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
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
                    <hr> </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{route('checkout.index')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>
        @else 
        <h2><strong> No items in Shopping Cart!</strong></h2>
         @endif
        <hr>
        <div class="table-main table-responsive">
            @if(Cart::instance('saveforlater')->count()>0)
        <h2><strong>{{Cart::instance('saveforlater')->count()}} item(s) saved for later.</strong></h2>
            <table class="table">
                <thead class="justify-content-between">
                    <tr>
                        <th>Images</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                        <th>Move to Cart</th>
                    </tr>
                </thead>
                @foreach (Cart::instance('saveforlater')->content() as $product)

                
                <tbody>
                    
                        
                    
                    <tr>
                        <td class="thumbnail-img">
                            <a href="{{route('products.show',$product->model->slug)}}">
                            <img class="img-fluid" src="{{ asset('storage/'.$product->model->image) }}" alt="" />
                    </a>
                        </td>
                        <td class="name-pr">
                        <a href="{{route('products.show',$product->model->slug)}}">
                        {{$product->model->name}}
                    </a>
                        </td>
                        <td class="price-pr">
                            <p>{{$product->model->price}}</p>
                        </td>
                        
                            <td class="quantity-box"><select class="quantity-sfl"  item-sfl-id="{{$product->rowId}}"><!--same products are saved in a row in Cart to select the product id we select the rowId-->
                                @for ($i = 1; $i <= 5; $i++)                    <!-- adding attribute so we can get this attribute in the below axios java script to find what is the value selected in the option -->
                            <option {{ $product->qty == $i ? 'selected':''}}>{{$i}}</option>   <!--select the value if quantity of product in cart is equal to option no-->
                                @endfor  
                            </td>
                            <td>
                            <p>{{$product->subtotal()}}</p>
                        </td>
                        
                        <td class="remove-pr">
                        <form action="{{route('saveforlater.delete',$product->rowId)}}" method="POST">
                            @csrf
                            @method('DELETE')
                         <i class="fas fa-times" style="position: relative"><button type="submit" class="btn" style="position:absolute;top:0;left:0;opacity:0"></button></i>
                        </form>
                    </a>
                        </td>
                        <td>
                        <form action="{{route('saveforlater.movetocart',$product->rowId)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Move to Cart</button>
                        </form>
                        </td>
                    </tr>
                    
                </tbody>
                @endforeach
            </table>
            @else 
            <h2>No items saved for later!!</h2>
            @endif
        </div>

    </div>
</div>
<!-- End Cart -->
    
@endsection

@section('qnt-js')
   <script>
       
    (function(){
        const classname = document.querySelectorAll('.quantity') //selects the class quantity in the cart and saveforlater quantity selecting option
        
        Array.from(classname).forEach(function(element){//Array converts the class elements into array
                element.addEventListener('change',function(){//adding eventlistener on the each element ie the options for change
                    const id = element.getAttribute('item-id')//gets the value of the option selected form the attribute that was added in the quantity select
                    axios.patch(`/cart/${id}`, {  //using axios to update the quantity of product Route::patch('/cart/{product}','CartController@update')->name('cart.update');
                       quantity: this.value   //gets the value of the option selected from the constant id
                    })
                    .then(function (response) {
                        window.location.href = '{{route('cart.index')}}'  //loads cart.index page since we have used response()->json() for both sucess and fail condition both will come to this 
                    })
                    .catch(function (error) {
                        window.location.href = '{{route('cart.index')}}'  //we havnt use error function so this is kinda useless we can use error() in cartcontroller for fail conditon to route our fail condition here.
                    });
                })
            })
            
        })();
        //same but for the saveforlater part.
        (function(){
                const classnamesfl = document.querySelectorAll('.quantity-sfl')
                 Array.from(classnamesfl).forEach(function(element){
                        element.addEventListener('change',function(){
                            const ids = element.getAttribute('item-sfl-id')
                            axios.patch(`/saveforlater/${ids}`, {
                            quantity: this.value
                            })
                            .then(function (response) {
                                window.location.href = '{{route('cart.index')}}'
                            })
                            .catch(function (error) {
                                window.location.href = '{{route('cart.index')}}'
                            });
                        })
                        })
           })();

       
            
       </script> 
@endsection
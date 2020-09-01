@extends('main.layouts.master')




@section('content')



<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Checkout</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Check Out</li>
                </ul>
            </div>
        </div>
        
    </div>
    
</div>
@include('main.includes.messages')
<!-- End All Title Box -->
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row new-account-login">
            <div class="col-sm-6 col-lg-6 mb-3">
                
                
                <div >
                   
                    <div class="checkout-address">

                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                      
                        
                            <script src="https://js.stripe.com/v3/"></script>
                            @auth
                            <form action="{{route('checkout.store')}}" method="post" id="payment-form"><!--for loggedin users-->
                            @else
                            <form action="{{route('guestcheckout.store')}}" method="post" id="payment-form"><!--for guest users-->

                            @endauth
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Valid last name is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Phone Number *</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="" required>
                                <div class="invalid-feedback"> Please enter a valid phone number for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            
                            <div class="row ">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Province *</label>
                                    <select class="wide w-100 dynamicoption" id="province" name="province" data-dependent="district" required>
                                    <option  value="Choose..." data-display="Select">Choose...Province</option>
                                    @foreach($provinces as $province)
                                    <option value="{{$province->province}}">{{$province->province}}</option>
                                    @endforeach
                                </select>
                                    <div class="invalid-feedback"> Please select a valid province. </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">District *</label>
                                    <select class="wide w-100 dynamicoption" id="district" name="district"  required>
                                    <option data-display="Select">Choose...District</option>
                                    
                                </select>
                                    <div class="invalid-feedback"> Please provide a valid district. </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="" required>
                                    <div class="invalid-feedback"> Zip code required. </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            
                            </div>
                            
                                <div ><!--<div class="form-row"> was creating a conflict with the app.css file so remove this class always-->
                                  <label for="card-element">
                                    <h4>Credit or debit card</h4> 
                                  </label>
                                  <div class="mb-3">
                                    <label for="cardName">Card Name *</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cardName" name="cardName" placeholder="" required>
                                        <div class="invalid-feedback" style="width: 100%;"> Your card name is required. </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                <div class="input-group"><!--making the cc part look like other part of form-->
                                  <div id="card-element" class="form-control">
                                    <!-- A Stripe Element will be inserted here. -->
                                  </div>
                                </div>
                            </div>
                              
                                  <!-- Used to display form errors. -->
                                  <div id="card-errors" role="alert"></div>
                                </div>
                              
                                <button class=" btn hvr-hover" style="margin-top: 2rem" id="complete-order">Pay with Card</button>
                              </form>
                        
                            
                            
                       
                    </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3" >
                
                <div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12" >
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span> </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">$10.00</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">$20.00</span> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12" >
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    @foreach (Cart::content() as $product)
                                    <div class="media mb-2 border-bottom">
                                    <div class="media-body"> <img style="width: 40px;height:40px" src="{{asset('storage/'.$product->model->image)}}" alt=""> <a href="{{route('products.show',$product->model->slug)}}">{{$product->model->name}}</a>
                                            <div class="small text-muted">Price: {{$product->model->price}} <span class="mx-2">|</span> Qty: 1 <span class="mx-2">|</span> Subtotal: {{$product->model->price}}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold">{{$finalsubamount}}</div>
                                </div>
                                
                                <hr class="my-1">
                                
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold">{{$finaltax}}</div>
                                </div>
                                
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5">{{$finalamount}}</div>
                                </div>
                                <div style="margin-left: 20rem">
                                    <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                    <input value="{{$finalamount}}" name="tAmt" type="hidden">
                                    <input value="{{$finalsubamount}}" name="amt" type="hidden">
                                    <input value="{{$finaltax}}" name="txAmt" type="hidden">
                                    <input value="0" name="psc" type="hidden">
                                    <input value="0" name="pdc" type="hidden">
                                    <input value="epay_payment" name="scd" type="hidden">
                                    <input value="{{rand(1,999999999999)}}" name="pid" type="hidden">
                                    <input value="http://127.0.0.1:8000/successpay" type="hidden" name="su">
                                    <input value="http://127.0.0.1:8000/failpay" type="hidden" name="fu">
                                    <button class="btn btn-success" type="submit"> <img style="height: 2.5rem;width:5rem" src="{{asset('imgs/logos/esewa/esewa-logo.png')}}" alt=""> Pay with esewa</button>
                                    </form>
                                </div>
                                <hr> </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
      
            
        </div>

    </div>
    <!--stripe js is in the checkout-stripe.js-->




<!-- End Cart -->




    
@endsection

@section('qnt-js')
   <script>
       
       $(document).ready(function(){

            $('.dynamicoption').change(function(){
            if($(this).val() != '')
            {
            var select = $(this).attr("id");//id of province  id='province'
            var value = $(this).val();//value of the province
            var dependent = $(this).data('dependent');//the value that is dependent on province ie district in this case
            var _token = $('input[name="_token"]').val();//this is the csrf token
            $.ajax({
            url:"{{ route('checkout.fetch') }}",
            method:"POST",
            data:{select:select, value:value, _token:_token, dependent:dependent},
            success:function(result)
            {
                $('#'+dependent).html(result); //replaces the html of #dependent=>id=dependent=>id='district';
            }

            })
            }
            });

           


});
</script>

@endsection
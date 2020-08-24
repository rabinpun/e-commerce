@extends('main.layouts.master')

@section('content')


<script src="https://js.stripe.com/v3/"></script>
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
<!-- End All Title Box -->
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row new-account-login">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="title-left">
                    <h3>Account Login</h3>
                </div>
                <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to Login</a></h5>
                <form class="mt-3 collapse review-form-box" id="formLogin">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">Password</label>
                            <input type="password" class="form-control" id="InputPassword" placeholder="Password"> </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Login</button>
                </form>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="title-left">
                    <h3>Create New Account</h3>
                </div>
                <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
                <form class="mt-3 collapse review-form-box" id="formRegister">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputName" class="mb-0">First Name</label>
                            <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputLastname" class="mb-0">Last Name</label>
                            <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputEmail1" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword1" class="mb-0">Password</label>
                            <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Register</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">
                <form action="{{route('checkout.store')}}" method="POST"  id="payment-form">
                    @csrf
                    <div  class="col-md-6 mb-3">
                        <label for="card-element">
                            Credit or debit card
                          </label>
                          <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                          </div>
                      
                          <!-- Used to display form errors. -->
                          <div id="card-errors" role="alert"></div>
                          
                    </div>
                    <button  id="submit">sd</button> 
                </form>
                <div class="checkout-address">
                    <div class="title-left">
                        <h3>Billing address</h3>
                    </div>
                  
                    <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name *</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback"> Valid first name is required. </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name *</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback"> Valid last name is required. </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username *</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" placeholder="" required>
                                <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email Address *</label>
                            <input type="email" class="form-control" id="email" placeholder="">
                            <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address *</label>
                            <input type="text" class="form-control" id="address" placeholder="" required>
                            <div class="invalid-feedback"> Please enter your shipping address. </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country *</label>
                                <select class="wide w-100" id="country">
                                <option value="Choose..." data-display="Select">Choose...</option>
                                <option value="United States">United States</option>
                            </select>
                                <div class="invalid-feedback"> Please select a valid country. </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State *</label>
                                <select class="wide w-100" id="province">
                                <option data-display="Select">Choose...</option>
                                <option >Alabama</option>
                                <option >Alaska</option>
                                <option >Arizona</option>
                                <option>Arkansas</option>
                                <option>California</option>
                                <option>Colorado</option>
                                <option>Connecticut</option>
                                <option>Delaware</option>
                                <option>District Of Columbia</option>
                                <option>Florida</option>
                                <option>Georgia</option>
                                <option>Hawaii</option>
                                <option>Idaho</option>
                                <option>Illinois</option>
                                <option>Indiana</option>
                                <option>Iowa</option>
                                <option>Kansas</option>
                                <option>Kentucky</option>
                                <option>Louisiana</option>
                                <option>Maine</option>
                                <option>Maryland</option>
                                <option>Massachusetts</option>
                                <option>Michigan</option>
                                <option>Minnesota</option>
                                <option>Mississippi</option>
                                <option>Missouri</option>
                                <option>Montana</option>
                                <option >Nebraska</option>
                                <option >Nevada</option>
                                <option >New Hampshire</option>
                                <option >New Jersey</option>
                                <option >New Mexico</option>
                                <option >New York</option>
                                <option >North Carolina</option>
                                <option>North Dakota</option>
                                <option >Ohio</option>
                                <option >Oklahoma</option>
                                <option >Oregon</option>
                                <option >Pennsylvania</option>
                                <option >Rhode Island</option>
                                <option >South Carolina</option>
                                <option >South Dakota</option>
                                <option >Tennessee</option>
                                <option >Texas</option>
                                <option >Utah</option>
                                <option >Vermont</option>
                                <option >Virginia</option>
                                <option >Washington</option>
                                <option >West Virginia</option>
                                <option >Wisconsin</option>
                                <option >Wyoming</option>

                            </select>
                                <div class="invalid-feedback"> Please provide a valid state. </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip *</label>
                                <input type="text" class="form-control" id="postalcode" placeholder="" required>
                                <div class="invalid-feedback"> Zip code required. </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required> <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback"> Name on card is required </div>
                            </div>
                            
                            <div  class="col-md-6 mb-3">
                                <label for="card-element">
                                    Credit or debit card
                                  </label>
                                  <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                  </div>
                              
                                  <!-- Used to display form errors. -->
                                  <div id="card-errors" role="alert"></div>
                                  
                            </div>
                    
                        </div>
                        
                        <hr class="mb-1"> 
                        <button id="submit" type="submit" class="btn hvr-hover">Checkout</button> 
                    </form>
                   
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
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
                    <div class="col-md-12 col-lg-12">
                        <div class="odr-box">
                            <div class="title-left">
                                <h3>Shopping cart</h3>
                            </div>
                            <div class="rounded p-2 bg-light">
                                @foreach (Cart::content() as $product)
                                <div class="media mb-2 border-bottom">
                                <div class="media-body"> <img style="width: 40px;height:40px" src="{{asset('imgs/products/laptops/'.$product->model->slug.'.jpg')}}" alt=""> <a href="{{route('products.show',$product->model->slug)}}">{{$product->model->name}}</a>
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
                            <hr> </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</div>
<body>
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
    <button class="btn btn-success" type="submit"> <img style="height: 5rem;width:10rem" src="{{asset('imgs/logos/esewa/esewa-logo.png')}}" alt=""> Pay with esewa</button>
    </form>
</body>

<!-- End Cart -->




    
@endsection

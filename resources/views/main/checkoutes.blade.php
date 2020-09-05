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
                      
                        
                            
                            @auth
                            <form action="{{route('checkoutes.store')}}" method="post" id="payment-form"><!--for loggedin users-->
                            @else
                            <form action="{{route('checkoutes.store')}}" method="post" id="payment-form"><!--for guest users-->

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
                                    <option  value="Choose...Province" data-display="Select">Choose...Province</option>
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
                            
                                
                                <input type="hidden" name="paymentmethod" value="esewa">
                              
                                <button class=" btn hvr-hover" style="margin-top: 2rem" id="complete-order">Pay with Esewa</button>
                             
                        
                            
                            
                       
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
                                        <input id="shippingOption1" name="outofvalley" id="outofvalley" class="custom-control-input" value="insidevalley" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Inside Valley</label> <span class="float-right font-weight-bold">FREE</span> </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="outofvalley" id="outofvalley" class="custom-control-input" value="outofvalley" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Outside Valley</label> <span class="float-right font-weight-bold">$10.00</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12" >
                            <div class="shipping-method-box">
                               
                        </div>
                    </form>
                    {{-- form end --}}
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
                        var select = $(this).attr("id");
                        var value = $(this).val();
                        var dependent = $(this).data('dependent');
                        var _token = $('input[name="_token"]').val();
                        axios.post(`{{route('address.fetch')}}`, {
                            select: select,
                            value: value,
                            dependent: dependent,
                            })
                            .then(function (result) {
                               console.log(result.data)
                               $('#'+dependent).html(result.data);
                            })
                        
                        }
                        });

                       //no need to put conditions for invalid data or when user hasnt selected any option as in fech we will only send choose district option only incase invalid data

                    //  


});
  
           



</script>

@endsection
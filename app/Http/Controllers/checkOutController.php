<?php

namespace App\Http\Controllers;

//use Cartalyst\StripeLaravel\Facades\Stripe;
//use Cartalyst\Stripe\Stripe;

use App\address;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Order;
use App\Order_Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class checkOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $provinces= address::groupBy('province')->get();//change the strict to false as it will make an error if true //groups the provinces by their name and takes one form each
        $finalamount=session()->get('finalamt')['newtotal'];
        $finalsubamount=session()->get('finalamt')['newsubtotal'];
        $finaltax=session()->get('finalamt')['newtax'];
        

        if(auth()->user() && request()->is('guestcheckout')){ //redirects to checkout instead of guestcheckout if the user is loggedin and still clicks on guest checkout or when a guest from guestcheckout signs in we redirect him to checkout instead of guestcheckout
            return redirect()->route('checkout.index');
        }

        return view('main.checkout')->with([
            'finalamount'=> $finalamount,
            'finalsubamount'=> $finalsubamount,
            'finaltax'=> $finaltax,
            'provinces'=>$provinces,
            
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function esindex()
    {
        session(['ese' => 'value']);
        session(['paymthd' => 'http://127.0.0.1:8000/checkoutes']);
        $provinces= address::groupBy('province')->get();//change the strict to false as it will make an error if true //groups the provinces by their name and takes one form each
        $finalamount=session()->get('finalamt')['newtotal'];
        $finalsubamount=session()->get('finalamt')['newsubtotal'];
        $finaltax=session()->get('finalamt')['newtax'];

        if(auth()->user() && request()->is('guestcheckout')){ //redirects to checkout instead of guestcheckout if the user is loggedin and still clicks on guest checkout or when a guest from guestcheckout signs in we redirect him to checkout instead of guestcheckout
            return redirect()->route('checkoutes.index');
        }

        return view('main.checkoutes')->with([
            'finalamount'=> $finalamount,
            'finalsubamount'=> $finalsubamount,
            'finaltax'=> $finaltax,
            'provinces'=>$provinces,
            
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function codindex()
    {
        session(['cod' => 'value']);
        session(['paymthd' => 'http://127.0.0.1:8000/checkoutcod']);
        
        $provinces= address::groupBy('province')->get();//change the strict to false as it will make an error if true //groups the provinces by their name and takes one form each
        $finalamount=session()->get('finalamt')['newtotal']??0;
        $finalsubamount=session()->get('finalamt')['newsubtotal']??0;
        $finaltax=session()->get('finalamt')['newtax']??0;

        if(auth()->user() && request()->is('guestcheckout')){ //redirects to checkout instead of guestcheckout if the user is loggedin and still clicks on guest checkout or when a guest from guestcheckout signs in we redirect him to checkout instead of guestcheckout
            return redirect()->route('checkout.indexcod');
        }

        return view('main.checkoutcod')->with([
            'finalamount'=> $finalamount,
            'finalsubamount'=> $finalsubamount,
            'finaltax'=> $finaltax,
            'provinces'=>$provinces,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        //dd($request->all());
        //this can be done with foreach but showing a bit variation
        $cartcontent=Cart::content()->map(function ($product){
                return $product->model->name.':'.$product->qty;
        })->values()->toJson();//converting to json format
        $finalamount=session()->get('finalamt')['newtotal'];  
        $sk=env('STRIPE_SECRET');    
        session()->put('finalamount',$finalamount);  
                
                try {
                            // Set your secret key. Remember to switch to your live secret key in production!
                // See your keys here: https://dashboard.stripe.com/account/apikeys
                \Stripe\Stripe::setApiKey($sk);//just to make a bit secure we are getting the key from .env file

                // Token is created using Stripe Checkout or Elements!
                // Get the payment token ID submitted by the form:
                
                $charge = \Stripe\Charge::create([
                'amount' => $finalamount*100,//stripe automatically divides the amount by 100 so we have to cancel it out by multipling by 100
                'currency' => 'npr',//must be npr it has predefined currency names
                'description' => 'Order',
                'source' => $request->stripeToken,
                'receipt_email'=>$request->email,
                'metadata'=>[
                    'contents'=>$cartcontent,
                    'quantity'=>Cart::instance('default')->count(),
                ],
                ]);
                // if(auth()->user())
                //     {
                //         $iduser=auth()->user()->id;
                //     }
                //     else
                //     {
                //         $iduser=null;
                //     }
                    //for some unknown reason turnery operator wasnt working
                    //P.S both didnt work coz the user_id was unfillable in order model
                    //insert into order table
                $order=Order::create([
                    'user_id'=> auth()->user() ? auth()->user()->id: null,
                    'billing_firstname'=>$request->firstName,
                    'billing_lastname'=>$request->lastName,
                    'billing_username'=>$request->username,
                    'billing_email'=>$request->email,
                    'billing_phone'=>$request->phone,
                    'billing_address'=>$request->address,
                    'billing_province'=>$request->province,
                    'billing_district'=>$request->district,
                    'billing_zip'=>$request->postalcode,
                    'billing_paymentmethod'=>$request->paymentmethod,
                    'billing_nameoncard'=>$request->cardName,
                    'billing_outofvalley'=>$request->outofvalley,
                    'error'=>null,
                    'billing_subtotal'=>session()->get('finalamt')['newsubtotal'],
                    'billing_taxtotal'=>session()->get('finalamt')['newtax'] ,
                    'billing_total'=>session()->get('finalamt')['newtotal'] ,
                     
                    ]);

                    //insert into order_product table

                    foreach(Cart::content() as $item){
                        Order_Product::create([
                            'order_id'=>$order->id,
                            'product_id'=>$item->model->id,
                            'quantity'=>$item->qty,
                        ]);
                    }
                $cartcontents=$order->products;
                Cart::instance('default')->destroy();//clears the cart after successful payment
                Mail::send(new OrderPlaced($cartcontents,$order));
                return redirect()->route('confirmation.index')->with('success_message','Card transaction successful!!');
                } catch (\Stripe\Exception\CardException $e) {//catching card error exception
                    $order=Order::create([
                        'user_id'=> auth()->user() ? auth()->user()->id: null,
                        'billing_firstname'=>$request->firstName,
                        'billing_lastname'=>$request->lastName,
                        'billing_username'=>$request->username,
                        'billing_email'=>$request->email,
                        'billing_phone'=>$request->phone,
                        'billing_address'=>$request->address,
                        'billing_province'=>$request->province,
                        'billing_district'=>$request->district,
                        'billing_zip'=>$request->postalcode,
                        'billing_paymentmethod'=>$request->paymentmethod,
                        'billing_nameoncard'=>$request->cardName,
                        'billing_outofvalley'=>$request->outofvalley,
                        'error'=>$e->getMessage(),//stores the error message
                        'billing_subtotal'=>session()->get('finalamt')['newsubtotal'],
                        'billing_taxtotal'=>session()->get('finalamt')['newtax'] ,
                        'billing_total'=>session()->get('finalamt')['newtotal'] ,
                         
                        ]);
                    return back()->with('cardfail',$e->getMessage());//outputs the error message
                }
    
            }
            /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function esstore(CheckoutRequest $request)
    {
        //dd($request->all());
        
                
        
                // if(auth()->user())
                //     {
                //         $iduser=auth()->user()->id;
                //     }
                //     else
                //     {
                //         $iduser=null;
                //     }
                    //for some unknown reason turnery operator wasnt working
                    //P.S both didnt work coz the user_id was unfillable in order model
                    //insert into order table
                $order=Order::create([
                    'user_id'=> auth()->user() ? auth()->user()->id: null,
                    'billing_firstname'=>$request->firstName,
                    'billing_lastname'=>$request->lastName,
                    'billing_username'=>$request->username,
                    'billing_email'=>$request->email,
                    'billing_phone'=>$request->phone,
                    'billing_address'=>$request->address,
                    'billing_province'=>$request->province,
                    'billing_district'=>$request->district,
                    'billing_zip'=>$request->postalcode,
                    'billing_paymentmethod'=>$request->paymentmethod,
                    'billing_nameoncard'=>$request->cardName,
                    'billing_outofvalley'=>$request->outofvalley,
                    'error'=>null,
                    'billing_subtotal'=>session()->get('finalamt')['newsubtotal'],
                    'billing_taxtotal'=>session()->get('finalamt')['newtax'] ,
                    'billing_total'=>session()->get('finalamt')['newtotal'] ,
                     
                    ]);

                    //insert into order_product table

                    foreach(Cart::content() as $item){
                        Order_Product::create([
                            'order_id'=>$order->id,
                            'product_id'=>$item->model->id,
                            'quantity'=>$item->qty,
                        ]);
                    }

                Cart::instance('default')->destroy();//clears the cart after successful payment
                return redirect()->route('confirmation.index')->with('success_message','Card transaction successful!!');
                
            }


            /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
            public function codstore(Request $request)
    {
        $order=Order::create([
            'user_id'=> auth()->user() ? auth()->user()->id: null,
            'billing_firstname'=>$request->firstName,
            'billing_lastname'=>$request->lastName,
            'billing_username'=>$request->username,
            'billing_email'=>$request->email,
            'billing_phone'=>$request->phone,
            'billing_address'=>$request->address,
            'billing_province'=>$request->province,
            'billing_district'=>$request->district,
            'billing_zip'=>$request->postalcode,
            'billing_paymentmethod'=>$request->paymentmethod,
            'billing_nameoncard'=>$request->cardName,
            'billing_outofvalley'=>$request->outofvalley,
            'error'=>null,
            'billing_subtotal'=>session()->get('finalamt')['newsubtotal'],
            'billing_taxtotal'=>session()->get('finalamt')['newtax'] ,
            'billing_total'=>session()->get('finalamt')['newtotal'] ,
             
            ]);

            //insert into order_product table

            foreach(Cart::content() as $item){
                Order_Product::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item->model->id,
                    'quantity'=>$item->qty,
                ]);
            }

        Cart::instance('default')->destroy();//clears the cart after successful payment
        return redirect()->route('confirmation.index')->with('success_message','Card transaction successful!!');
        
    
            }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function fetch(Request $request)
    {
        
       //can use this method to make categories for elctronics clothes home decor 
      //we can also add country before province or add city after district to make it more dynamic
    $select = $request->select;
     $value = $request->value;
     $dependent = $request->dependent;
     
     //since we are making only one element (district) dyanmic so i kept the name $district it can be named more intuitive or multiple dynamic selects
     $districts =address::where($select, $value)->get();
     $output = '<option value="">Choose...'.ucfirst($dependent).'</option>';//ucfirst makes the first letter capital
     foreach($districts as $district)
     {
      $output .= '<option value="'.$district->$dependent.'">'.$district->$dependent.'</option>';
     }
     echo $output;
    }
    
}

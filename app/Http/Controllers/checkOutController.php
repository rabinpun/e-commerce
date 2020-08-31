<?php

namespace App\Http\Controllers;

//use Cartalyst\StripeLaravel\Facades\Stripe;
//use Cartalyst\Stripe\Stripe;

use App\Http\Requests\CheckoutRequest;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;



class checkOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finalamount=session()->get('finalamt')['newtotal'];
        $finalsubamount=session()->get('finalamt')['newsubtotal'];
        $finaltax=session()->get('finalamt')['newtax'];

        if(auth()->user() && request()->is('guestcheckout')){ //redirects to checkout instead of guestcheckout if the user is loggedin and still clicks on guest checkout or when a guest from guestcheckout signs in we redirect him to checkout instead of guestcheckout
            return redirect()->route('checkout.index');
        }

        return view('main.checkout')->with([
            'finalamount'=> $finalamount,
            'finalsubamount'=> $finalsubamount,
            'finaltax'=> $finaltax
            
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
        //this can be done with foreach but showing a bit variation
        $contents=Cart::content()->map(function ($product){
                return $product->model->slug.':'.$product->qty;
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
                    'contents'=>$contents,
                    'quantity'=>Cart::instance('default')->count(),
                ],
                ]);
                Cart::instance('default')->destroy();//clears the cart after successful payment
                return redirect()->route('confirmation.index')->with('success_message','Card transaction successful!!');
                } catch (\Stripe\Exception\CardException $e) {//catching card error exception
                    return back()->with('cardfail','Card Invalid!! Card details incorrect or use another card.');
                }
    
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
        //
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
        //
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
}

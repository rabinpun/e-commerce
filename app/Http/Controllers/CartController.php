<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $discount=session()->get('usedcoupon')['discount']  ?? 0; //its sets value to 0 if there is no such item in session otherwise there will be error 
        $newsubtotal=Cart::subtotal()-$discount;
        $newtax=config('cart.tax')/100 * $newsubtotal;//config('cart.tax') this gets the tax value from the cart.php in config folder
        $newtotal=$newsubtotal+$newtax;
        session()->put('finalamt',[
            'newtotal'=>$newtotal,
            'newsubtotal'=>$newsubtotal,
            'newtax'=>$newtax
            ]);
        return view('main.cart')->with(
            [
                'newsubtotal'=>$newsubtotal,
                'newtax'=>$newtax,
                'newtotal'=>$newtotal
    
            ]
        );
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
    public function store(Request $request)
    {
       $duplicate=Cart::search(function($cartItem,$rowId) use ($request)
       {
           return $cartItem->id === $request->id;
       });
       if($duplicate->isNotEmpty())
       {
           return redirect()->route('cart.index')->withsuccess_message('Item is already in your Cart!!!');
       }
        Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','Item was added to your cart!');
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
        $validator = Validator::make($request->all(),[
            'quantity'=>'required|numeric|between:1,5'

        ]);
        if($validator->fails()){
           
            session()->flash('errors',collect(['Please select between 1 and 5']));
            return response()->json(['success'=>false]);//goes to response of axios with json having success false  we can use error also for this
        }
        Cart::update($id, $request->quantity);
        session()->flash('success_message','Item quantity updated.');
        return response()->json(['success'=>true]);//we cant use view or redirect we can only use response or error if response goes to response if error goes to error 
                                        // success true is just flagging success var to true nothing much
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        Cart::remove($id);
        return back()->with('success_message','Item removed form Shopping Cart.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveforlater($id)
    {

        $item= Cart::get($id);

        Cart::remove($id);
        $duplicate=Cart::instance('saveforlater')->search(function($cartItem,$rowId) use ($id)
       {
           return $rowId === $id;
       });
       if($duplicate->isNotEmpty())
       {
           return redirect()->route('cart.index')->withsuccess_message('Item is already in saved for later!!!');
       }
        
        Cart::instance('saveforlater')->add($item->id,$item->name,$item->qty,$item->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','Item saved for later!');
    }
    }




  



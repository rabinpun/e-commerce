<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class saveforlaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
            'quantity'=>'required|numeric|between:1,5'   //validating the quantity

        ]);
        if($validator->fails()){    //if validation fails
           
            session()->flash('errors',collect(['Please select between 1 and 5']));   
            return response()->json(['success'=>false]); 
        }
        Cart::instance('saveforlater')->update($id, $request->quantity);
        session()->flash('success_message','Item quantity updated.');
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Cart::instance('saveforlater')->remove($id);
        return back()->with('success_message','Item removed form Save for later.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function movetocart($id)
    {

        $item= Cart::instance('saveforlater')->get($id);

        Cart::instance('saveforlater')->remove($id);
        $duplicate=Cart::instance('default')->search(function($cartItem,$rowId) use ($id)
       {
           return $rowId === $id;
       });
       if($duplicate->isNotEmpty())
       {
           return redirect()->route('cart.index')->withsuccess_message('Item is already in saved for later!!!');
       }
        
        Cart::instance('default')->add($item->id,$item->name,1,$item->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','Item moved to Cart!');
    }

}

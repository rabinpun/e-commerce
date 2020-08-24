<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code',$request->coupon_code)->first();
        if (!$coupon) {
            return redirect()->route('cart.index')->witherrors('Coupon is incorrect!!');
        }
        session()->put('usedcoupon',[
            'name'=>$coupon->code,
            'discount'=>$coupon->discount(Cart::subtotal())
        ]);
        
          

        return redirect()->route('cart.index')->with([
            'success_message'=>'Coupon applied successfully!!!',
           

        ]);


    }

  

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('usedcoupon');
        return redirect()->route('cart.index')->withsuccess_message('Coupon Removed!!');
    }
}

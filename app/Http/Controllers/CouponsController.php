<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Jobs\UpdateCoupon;
//use Gloudemans\Shoppingcart\Facades\Cart;//we dont need this we have this in the job UpdateCoupon

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

        //we are putting it in session so we can use this information like when sending the discount to the checkout page and getting the coupon information in the evnet listner
        // session()->put('usedcoupon',[
        //     'name'=>$coupon->code,
        //     'discount'=>$coupon->discount(Cart::subtotal())
        // ]);

        dispatch_now(new UpdateCoupon($coupon));
        
          

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

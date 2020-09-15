<?php

namespace App\Listeners;

use App\Coupon;
use App\Jobs\UpdateCoupon;
//use Gloudemans\Shoppingcart\Facades\Cart;//we dont need this we have this in the job UpdateCoupon
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CartUpdatedListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //the update method is dont in ajax so it also catches that but dd('event caught') wont work it will just halt and reload page with same data but dd will work for removing an item and adding an item
        //since we dont have access to request we will get the coupon from session
        //$coupon = Coupon::where('code',$request->coupon_code)->first();

        $coupon_code=session()->get('usedcoupon','name');
        if($coupon_code)
        {
            $coupon = Coupon::where('code',$coupon_code)->first();
        
            //this will update the coupon and the discount value
            
            //we will remove the below code with a job since this code is also repeated in the couponcontroller a bit of code cleanup
            // session()->put('usedcoupon',[
            //     'name'=>$coupon->code,
            //     'discount'=>$coupon->discount(Cart::subtotal())
            // ]);

            //UpdateCoupon::dispatch();//this is default way to dispatch a job but if we have multiple jobs and there is a queue then this will be put on the queue
            //we dont want this job to be in queue we want it to execute it immediatly
            if($coupon){
                dispatch_now(new UpdateCoupon($coupon));
            }
            
            //job executed immediately
            
        }
        
        //This is handled by the controller and also this is the case when there is already a coupon so it is meaning less 
        // if (!$coupon) {
        //     return redirect()->route('cart.index')->witherrors('Coupon is incorrect!!');
        // }


        
    }
}

<?php

namespace App\Jobs;

use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCoupon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $coupon;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        //construct is the first function that is executed so we pass the arguemnts or variables to the construct most of the times
        //passing the coupon code name to updatecoupon job.
        $this->coupon=$coupon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        session()->put('usedcoupon',[
            'name'=>$this->coupon->code,
            'discount'=>$this->coupon->discount(Cart::subtotal())
        ]);
    }
}

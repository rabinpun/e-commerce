<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],


        //to listen to the cart added,updated and removed events to remove the bug of percentage based discount not updating when cart is updated
        //must be cart.added,cart.updated and cart.removed since it is default event names set when the cart is updated added and deleted given in documatation of cartalyst also
        //when we add an item in cart the cart.added event happens (its set by the developers) so if the event cart.added occurs the App\Listeners\CartUpdatedListner.php executes where we update the new discount value
        
        
        'cart.added'=>['App\Listeners\CartUpdatedListner'],

        'cart.updated'=>['App\Listeners\CartUpdatedListner'],

        'cart.removed'=>['App\Listeners\CartUpdatedListner'],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

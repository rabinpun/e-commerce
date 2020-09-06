<?php

namespace App\Mail;

use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;


    public $cartcontents;//so that we can get the contents of cart in email
    public $order;//so that we can get order info in the email
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($cartcontents,Order $order)
    {
        $this->cartcontents = $cartcontents;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this  //->from('simula@gmail.com','simula')//whatever you write in email address the mail will be sent from rabinpun4949@gmail.com but the name of sender will change if you change here
        ->to($this->order->billing_email,$this->order->billing_firstname.' '.$this->order->billing_lastname)//reciver will receive to Hiralal instead of his name
         ->bcc('simara@simar.com')
         ->subject('Your Order from Ecommerce')
        ->view('emails.orders.placed');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailcontroller extends Controller
{
    public function index(){
        Mail::send(new OrderPlaced);
        return 'sent';

    }
}

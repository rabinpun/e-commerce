<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(){
        $products=Product::where('featured',true)->paginate(4);
        return view('main.index')->with('products',$products);
    }
    
}

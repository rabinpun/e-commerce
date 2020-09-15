<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use TCG\Voyager\Models\Post;

class IndexController extends Controller
{
    public function index(){
        $products=Product::where('featured',true)->paginate(4);
        $posts=Post::latest()->limit(3)->get();

        

        return view('main.index',compact('posts'))->with('products',$products);
    }
    
}

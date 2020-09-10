<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (request()->category) {//enters if we have a query ie if we click on the link of the categories which has a route and a query 'category'=>$category->slug
                $products=Product::with('categories')->whereHas('categories',function($query){
                    //access product with category           
                    $query->where('slug',request()->category);//selects the slug which is equal to the slug sent from the query ie if we click on laptop category sends the all the product with laptop slug which is accessed form the category_product_table
                    
                
                });
                $categories=Category::all();
                $categoryName=$categories->where('slug',request()->category)->first()->name;//gets the name of the catogry by checking the request's category's and the category table
                $countno=$products->count();
                
            }
            else {
            $products=Product::where('featured',true);
            $categories=Category::all();
            $categoryName='Featured Products';
            $countno=$products->count();
            }
            
            if(request()->sort == 'high_low'){//if selected high to low
                $products = $products->orderBy('price','desc')->paginate(9);//we cant use collection methods like all(),get() when using pagination since pagination is query builder so only take(),where() etc can be used together with pagination
            }elseif(request()->sort == 'low_high'){//if selected low to high
                $products = $products->orderBy('price')->paginate(9);
            }
            else{
                $products=$products->paginate(9);//pagination for no sort request or category request. ie when product.index requested
            }

            $totalelectronicscount=Product::all()->count();

            return view('main.products')->with([
                'products'=>$products,
                'categories'=>$categories,
                'categoryName'=>$categoryName,
                'countno'=>$countno,
                'totalcount'=>$totalelectronicscount
                ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $mal_products=Product::where('slug','!=',$slug)->MightAlsoLike()->get();
        $product=Product::where('slug',$slug)->firstOrFail();
        //  dd($product->price);
        return view('main.product')->with([
            'product'=>$product,
            'mal_products'=>$mal_products
            ]);
    }
    public function search(Request $request)
    {
       // dd(request()->search);
            if(request()->search){
                $request->validate([
                    'search'=>'required|min:3'
                ]);
                $search=request()->search;
                //$search=$request->input('query');if you use name as query instead of search
                //search=request()->query  wont work but the above will work
                //$search=$request->input('search');//same thing
                //$products=Product::where('name','like',"%$search%");//like is used when we are searching a pattern of string instead of exact string it is used with wild card operators % % is a wild card character where it searches any string with the given string %bl% will find bl,black,blue,bloom etc
                //this method is less accourate like if we search for 'is black' if there is a string 'is a black' the result wont show this as it has to be continuous
                //the following method does a full text method so the arrangement and place ment of string words wont matter better also comes in a package so easy to user
                $products = Product::search($search);
                
                $categoryName='Search Result';
                $countno=$products->count();
                $categories=Category::all();
            }
            
            
            if(request()->sort == 'high_low'){//if selected high to low
                $products = $products->orderBy('price','desc')->paginate(9);//we cant use collection methods like all(),get() when using pagination since pagination is query builder so only take(),where() etc can be used together with pagination
            }elseif(request()->sort == 'low_high'){//if selected low to high
                $products = $products->orderBy('price')->paginate(9);
            }
            else{
                $products=$products->paginate(9);//pagination for no sort request or category request. ie when product.index requested
            }

            $totalelectronicscount=Product::all()->count();
            
            return view('main.search')->with([
                'products'=>$products,
                'categories'=>$categories,
                'categoryName'=>$categoryName,
                'countno'=>$countno,
                'totalcount'=>$totalelectronicscount
                ]);
        
    }

}
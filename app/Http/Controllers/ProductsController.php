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

}
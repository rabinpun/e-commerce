<?php

namespace App\Http\Controllers;

use App\Product;
use App\wishlist_pivot;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=auth()->user()->wishlistproducts;
        return view('main.wishlist',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        if(wishlist_pivot::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first()){
            return redirect()->route('wishlist.index')->withErrors('Item is already in your wishlist!');
        };
        wishlist_pivot::create(['user_id'=>auth()->user()->id,'product_id'=>$product->id]);
        return redirect()->route('wishlist.index')->with('success_message','Item was added to your wishlist!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlistitem=wishlist_pivot::where('user_id',auth()->user()->id)->where('product_id',$id)->first();
            $wishlistitemid=$wishlistitem->id;
            wishlist_pivot::destroy($wishlistitemid);
        return back()->with('success_message','Item removed form Wishlist.');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable= ['user_id','billing_firstname','billing_lastname','billing_username','billing_email','billing_phone','billing_address','billing_province','billing_district','billing_zip','billing_paymentmethod','billing_nameoncard','billing_outofvalley','error','billing_subtotal','billing_taxtotal','billing_total'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function products(){
        return $this->belongsToMany('App\Product')->withPivot('quantity');//with pivot allows us to access the quantity of the product at pivot table with the products method. we can get product's quantity by $product->pivot->quantity look in the read view of the custom order
    }
}

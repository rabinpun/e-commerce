<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlist_pivot extends Model
{
    protected $table ='wishlist_pivots';
    protected $fillable =['user_id','product_id'];

    

}

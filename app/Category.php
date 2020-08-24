<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = "category";//setting the name of the table of model category to category instead of default categories because we are using the voyager admin panel which also has categories table and two can conflict with eachother
    public function products(){
        return $this->belongsToMany('App\Product');//making one to many relation where category has many products
    }
}

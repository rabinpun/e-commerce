<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Product extends Model
{
    protected $table='Category_Product';
    protected $fillable = ['Product_id','Category_id'];
}

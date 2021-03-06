<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Category;

class Product extends Model
{
    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ],
    ];

    protected $fillable= ['quantity'];

    function previousPrice(){
        return ($this->price + $this->price*0.2); //showing the previous undiscounted price
    }
  
    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(8);//making shortcut of long chains//to not repeat codes
    }
    public function categories(){//this is a method which is called in seeder to associate or attach category to products
        return $this->belongsToMany('App\Category');//making one to many relation with the categories table since we are adding a feature such that one product can have many categories ideally it should be belongsTo
    }
    public function users(){
        return $this->belongsToMany('App\User','wishlist_pivots');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code){//static coz we can use self method to call the same class Coupon
        return self::where('code',$code)->first(); //self here means coupon
    } 
    public function discount($total){
        if($this->type == 'fixed'){
            return $this->value;
        }
        elseif($this->type == 'percent'){
            return round(($this->percent_off / 100) * $total);
        }
        else{
            return 0;
        }
    }
}

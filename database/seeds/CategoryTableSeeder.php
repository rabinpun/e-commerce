<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Category::insert([
            ['name'=>'Laptops','slug'=>'laptops','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Desktops','slug'=>'desktops','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Appliances','slug'=>'appliances','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Mobiles','slug'=>'mobiles','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Tvs','slug'=>'tvs','created_at'=>$now,'updated_at'=>$now],
        ]);

    }
}

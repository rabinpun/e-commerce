<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=9 ; $i++) { 
            Product::create([
                'name'=>'Laptop '.$i,
                'slug'=>'laptop-'.$i,
                'details'=>[15,16,16.5][array_rand([15,16,16.5])].'inch, '.[1,2,3][array_rand([1,2,3])].'TB SSD,'.[4,8,16][array_rand([4,8,16])].'GB RAM',
                'price'=>[100,200,300][array_rand([100,200,300])],
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus doloribus cum voluptatibus. Nostrum repellendus assumenda iure, praesentium ipsum dicta cupiditate quas dolor explicabo perspiciatis veritatis quisquam aspernatur enim ipsa! Possimus?',
                'category'=>'laptops',
            ])->categories()->attach([1,2]);//made the laptop part both laptop and desktop
        }//no need to change categories to category because it is a method only it can be named any thing it was named categries in product model so it can be left same
        //$product=Product::find(1);//finding the first item we will make the first item both desktop and laptop
        //$product->categories()->attach(3);//attaching the desktop id
            for ($i=1; $i <=15 ; $i++) { 
                Product::create([
                    'name'=>'Appliance '.$i,
                    'slug'=>'appliance-'.$i,
                    'details'=>['fridge','oven','washingmachine'][array_rand(['fridge','oven','washingmachine'])].', '.[200,300,400][array_rand([1,2,3])].'watt power usage,'.[110,220,440][array_rand([110,220,440])].' operating voltage',
                    'price'=>[100,200,300][array_rand([100,200,300])],
                    'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus doloribus cum voluptatibus. Nostrum repellendus assumenda iure, praesentium ipsum dicta cupiditate quas dolor explicabo perspiciatis veritatis quisquam aspernatur enim ipsa! Possimus?',
                    'category'=>'appliances',
                ])->categories()->attach(3);
            }
                for ($i=1; $i <=15 ; $i++) { 
                    Product::create([
                        'name'=>'Desktop '.$i,
                        'slug'=>'desktop-'.$i,
                        'details'=>[15,16,16.5][array_rand([15,16,16.5])].'inch, '.[1,2,3][array_rand([1,2,3])].'TB SSD,'.[4,8,16][array_rand([4,8,16])].'GB RAM',
                        'price'=>[100,200,300][array_rand([100,200,300])],
                        'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus doloribus cum voluptatibus. Nostrum repellendus assumenda iure, praesentium ipsum dicta cupiditate quas dolor explicabo perspiciatis veritatis quisquam aspernatur enim ipsa! Possimus?',
                        'category'=>'desktops',
                    ])->categories()->attach(2);
    
        }
        for ($i=1; $i <=15 ; $i++) { 
            Product::create([
                'name'=>'Mobile '.$i,
                'slug'=>'mobile-'.$i,
                'details'=>[5,6,6.5][array_rand([5,6,6.5])].'inch screen display, '.[50,60,70][array_rand([50,60,70])].'GB storage,'.[4,8,16][array_rand([4,8,16])].'GB RAM',
                'price'=>[100,200,300][array_rand([100,200,300])],
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus doloribus cum voluptatibus. Nostrum repellendus assumenda iure, praesentium ipsum dicta cupiditate quas dolor explicabo perspiciatis veritatis quisquam aspernatur enim ipsa! Possimus?',
                'category'=>'mobiles',
            ])->categories()->attach(4);

            }
            for ($i=1; $i <=15 ; $i++) { 
                Product::create([
            'name'=>'Tv '.$i,
            'slug'=>'tv-'.$i,
            'details'=>[15,16,16.5][array_rand([15,16,16.5])].'inch display, '.['oled','lcd','crt'][array_rand(['oled','lcd','crt'])].' screen',
            'price'=>[100,200,300][array_rand([100,200,300])],
            'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus doloribus cum voluptatibus. Nostrum repellendus assumenda iure, praesentium ipsum dicta cupiditate quas dolor explicabo perspiciatis veritatis quisquam aspernatur enim ipsa! Possimus?',
            'category'=>'tvs',
                ])->categories()->attach(5);

    }        
        }
    }

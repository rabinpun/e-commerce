<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {///make sure you name this category_product if u make use php artisan make:model Category_Product -m then it will make the table name category_products. but when inserting laravel will search for the category_product table so manually rename it or make manual migration like php artisan:make migration create_Category_Product_Table
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();//creates an unsigned integer product_id which can be nulled nothing special
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');//foreign method means it is referencing the its own table element in this case the product_id by writing foreign('product_id')  from another foreign element 'id'//id of the product in products table// from another table in this case the main product table onDelete('cascade') means if the foreign element is delete it is also deleted here
            
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            

            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category__products');
    }
}

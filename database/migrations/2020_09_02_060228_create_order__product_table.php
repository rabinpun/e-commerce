<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');//id()->bigInteger, increments('id)->integer
            $table->bigInteger('order_id')->unsigned()->nullable();//orders has id() which is big integer and unsigned so this order_id must be biginteger and unsigned datatype mismatch makes creation of malformed foreign key
            $table->foreign('order_id')->references('id')->on('orders')
            ->onUpdate('cascade')->onDelete('set null');
            $table->integer('product_id')->unsigned()->nullable();//products has increments('id') which is integer so use integer
            $table->foreign('product_id')->references('id')->on('products')
            ->onUpdate('cascade')->onDelete('set null');

            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('order__product');
    }
}

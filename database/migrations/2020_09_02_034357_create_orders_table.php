<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();//it becomes null if the user is guest
            $table->foreign('user_id')->references('id')->on('users')//the user_id is refrecenced from id from users table
            ->onUpdate('cascade')->onDelete('set null');//when user updated the his order the order here is also updated??need to understandmore when user deletes the account the user_id becomes null the order itself is not deleted
            $table->string('billing_firstname');
            $table->string('billing_lastname');
            $table->string('billing_username');
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->string('billing_address');
            $table->string('billing_province');
            $table->string('billing_district');
            $table->string('billing_zip')->nullable();
            $table->string('billing_paymentmethod')->default('paymentondelivery');
            $table->string('billing_nameoncard')->nullable();
            $table->string('billing_outofvalley');
            $table->string('error')->nullable();
            $table->string('billing_subtotal');
            $table->string('billing_taxtotal');
            $table->string('billing_total');



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
        Schema::dropIfExists('orders');
    }
}

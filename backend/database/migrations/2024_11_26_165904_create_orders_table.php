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
            $table->unsignedBigInteger('customer_id');
            $table->integer('total_amount')->comment("total orginal price of product");
            $table->integer('order_amount')->comment("total amount of ordered product; no shipping charge included");
            $table->integer('shipping_charge');
            $table->integer('discount');
            $table->integer('payment_type')->comment('1=>Online, 2=>COD');
            $table->integer('payment_status')->comment('1=>Paid, 0=>Unpaid');
            $table->string('transaction_id')->nullable();
            $table->unsignedBigInteger('order_status');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('order_status')->references('id')->on('order_status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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

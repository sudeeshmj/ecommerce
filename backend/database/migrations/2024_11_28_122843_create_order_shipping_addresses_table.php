<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('name');
            $table->string('phone_number');
            $table->integer('pincode');
            $table->string('locality');
            $table->string('address');
            $table->string('city');
            $table->unsignedBigInteger('state_id');
            $table->string('landmark');
            $table->integer('address_type')->comment('1=>Home,2=>Work');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('order_shipping_addresses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('name');
            $table->string('phone_number');
            $table->integer('pincode');
            $table->string('locality');
            $table->string('address');
            $table->string('city');
            $table->unsignedBigInteger('state_id');
            $table->string('landmark');
            $table->integer('address_type')->comment('1=>Home,2=>Work');
            $table->integer('default_address')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('state_id')->references('id')->on('states');
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
        Schema::dropIfExists('delivery_addresses');
    }
}

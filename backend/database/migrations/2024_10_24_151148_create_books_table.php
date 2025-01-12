<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('publisher_id');
            $table->date('publishing_date');
            $table->integer('edition');
            $table->string('isbn');
            $table->string('format');
            $table->integer('pages');
            $table->text('summary');
            $table->text('image');
            $table->integer('price');
            $table->integer('offer_price');
            $table->integer('stock');
            $table->integer('threshold_stock');
            $table->boolean('outofstock_notify');
            $table->enum('status',[0,1])->default('1')->comment('1-Active, 0-Inactive');
            // Foreign keys
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('publisher_id')->references('id')->on('publishers');
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
        Schema::dropIfExists('books');
    }
}

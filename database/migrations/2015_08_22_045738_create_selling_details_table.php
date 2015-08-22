<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('selling_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('unit', 10);
            $table->integer('selling_price')->unsigned();
            $table->integer('discount')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('amount')->unsigned();
            $table->timestamps();
            $table->integer('created_by')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('selling_details');
    }
}

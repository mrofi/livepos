<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchasing_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('product_name', 50);
            $table->string('unit', 10);
            $table->decimal('purchase_price', 12, 2)->unsigned();
            $table->decimal('discount', 5, 2)->unsigned();
            $table->decimal('quantity', 10, 3)->unsigned();
            $table->decimal('amount', 12, 2)->unsigned();
            $table->timestamps();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchasing_details');
    }
}

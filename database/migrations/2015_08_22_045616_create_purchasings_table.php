<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_no', 20);
            $table->integer('supplier_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->integer('discount')->unsigned();
            $table->integer('total_amount')->unsigned();
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
        Schema::drop('purchasings');
    }
}

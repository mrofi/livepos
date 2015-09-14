<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_no', 50)->unique();
            $table->integer('customer_id')->unsigned();
            $table->decimal('amount', 12, 2)->unsigned();
            $table->decimal('discount', 5, 2)->unsigned();
            $table->decimal('total_amount', 12, 2)->unsigned();
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
        Schema::drop('sellings');
    }
}

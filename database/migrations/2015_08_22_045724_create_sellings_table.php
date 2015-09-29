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
            $table->decimal('discount', 12, 2)->unsigned();
            $table->decimal('total_amount', 12, 2)->unsigned();
            $table->decimal('cash', 12, 2)->unsigned();
            $table->decimal('change', 12, 2)->unsigned();
            $table->decimal('profit', 12, 2)->unsigned();
            $table->enum('done', ['0', '1'])->default('0');
            $table->decimal('shop_commision', 12, 2)->unsigned();
            $table->enum('multilevel', ['0', '1'])->default('0');
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

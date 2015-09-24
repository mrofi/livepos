<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellingCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_commisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('selling_id')->unsigned();
            $table->decimal('shop_commision', 12, 2)->unsigned();
            $table->enum('multilevel', ['0', '1']);
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
        Schema::drop('selling_commisions');
    }
}

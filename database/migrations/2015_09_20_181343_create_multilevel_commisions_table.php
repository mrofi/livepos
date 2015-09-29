<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultilevelCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multivel_commisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('selling_id')->unsigned();
            $table->integer('multilevel_id')->unsigned();
            $table->decimal('commision', 12, 2)->unsigned();
            $table->enum('redeem', ['0', '1'])->default('0');
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
        Schema::drop('multivel_commisions');
    }
}

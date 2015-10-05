<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer', 50);
            $table->string('code', 6);
            $table->string('id_no', 25);
            $table->string('id_type', '20');
            $table->string('address');
            $table->string('contact1', '13');
            $table->string('contact2', '13');
            $table->enum('active', ['0', '1'])->default('1');
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
        Schema::drop('customers');
    }
}

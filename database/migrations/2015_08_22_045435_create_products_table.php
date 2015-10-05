<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('barcode', 20)->unique()->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->string('unit', 10);
            $table->decimal('min_stock', 10, 3)->unsigned()->default('0');
            $table->decimal('purchase_price', 12, 2)->unsigned();
            $table->decimal('selling_price', 12, 2)->unsigned();
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
        Schema::drop('products');
    }
}

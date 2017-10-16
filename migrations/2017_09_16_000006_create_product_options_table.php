<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            // $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 15, 4)->default(0.0000);
            $table->integer('quantity')->unsigned()->default(0)->comment('库存');
            $table->boolean('subtract')->default(0)->comment('减少库存');
            $table->smallInteger('sort_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}

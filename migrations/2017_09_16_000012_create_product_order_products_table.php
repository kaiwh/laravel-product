<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOrderProductsTable extends Migration
{
    public function up()
    {
        Schema::create('product_order_products', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->default(0);
            $table->integer('product_id')->unsigned()->default(0);
            $table->integer('option_id')->unsigned()->default(0);
            $table->primary(['order_id', 'product_id', 'option_id']);
            $table->string('title')->nullable();
            $table->decimal('price', 15, 4)->default(0.0000);
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('total', 15, 4)->default(0.0000);
            $table->boolean('subtract')->default(0)->comment('减少库存');
        });
    }

    public function down()
    {
        Schema::drop('product_order_products');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOrderShippingsTable extends Migration
{
    public function up()
    {
        Schema::create('product_order_shippings', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->default(0);
            $table->primary('order_id');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('province_id')->unsigned()->default(0);
            $table->integer('city_id')->unsigned()->default(0);
            $table->integer('district_id')->unsigned()->default(0);
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('product_order_shippings');
    }
}

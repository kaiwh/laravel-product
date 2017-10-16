<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->decimal('total', 15, 4)->default(0.0000);
            $table->integer('order_status_id')->default(0);
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('accept_language')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('product_orders');
    }
}

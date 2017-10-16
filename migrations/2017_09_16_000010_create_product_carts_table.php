<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCartsTable extends Migration
{
    public function up()
    {
        Schema::create('product_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('product_id')->unsigned()->default(0);
            $table->integer('option_id')->unsigned()->default(0);
            $table->integer('quantity')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('product_carts');
    }
}

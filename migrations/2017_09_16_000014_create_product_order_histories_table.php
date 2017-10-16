<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOrderHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('product_order_histories', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->default(0);
            $table->integer('order_status_id')->unsigned()->default(0);
            $table->primary(['order_id', 'order_status_id']);
            $table->boolean('notify')->unsigned()->default(0);
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('product_order_histories');
    }
}

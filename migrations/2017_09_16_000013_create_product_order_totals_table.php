<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOrderTotalsTable extends Migration
{
    public function up()
    {
        Schema::create('product_order_totals', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->default(0);
            $table->string('code')->nullable();
            $table->primary(['order_id', 'code']);
            $table->string('title')->nullable();
            $table->decimal('value', 15, 4)->default(0.0000);
            $table->smallInteger('sort_order')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::drop('product_order_totals');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('image')->nullable();
            $table->decimal('price', 15, 4)->default(0.0000);
            $table->integer('quantity')->unsigned()->default(0)->comment('库存');
            $table->integer('minimum')->unsigned()->default(0)->comment('最小购买量');
            $table->boolean('subtract')->default(0)->comment('减少库存');
            $table->boolean('option_status')->default(0)->comment('选项必选？');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('products');
    }
}

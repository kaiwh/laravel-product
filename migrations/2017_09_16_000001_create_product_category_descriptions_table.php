<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_descriptions', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->string('language', 64);
            $table->primary(['category_id', 'language']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category_descriptions');
    }
}

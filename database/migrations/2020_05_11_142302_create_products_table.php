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
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->unsignedInteger('sub_sub_category_id')->nullable();
            $table->string('name');
            $table->unsignedInteger('unit_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('full_image')->nullable();
            $table->string('thumbs')->nullable();
            $table->tinyInteger('status');
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

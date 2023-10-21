<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('1=finished Goods In,2=out,3=utilize');
            $table->unsignedInteger('warehouse_id');
            $table->text('barcode');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');
            $table->unsignedInteger('sub_sub_category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('size_id');
            $table->float('quantity',50);
            $table->float('unit_price',50);
            $table->unsignedInteger('finished_goods_id')->nullable();
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
        Schema::dropIfExists('inventory_logs');
    }
};

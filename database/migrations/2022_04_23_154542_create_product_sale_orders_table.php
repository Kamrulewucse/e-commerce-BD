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
        Schema::create('product_sale_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sale_order_id');
            $table->unsignedInteger('product_id');
            $table->string('product_name');
            $table->string('color')->nullable();
            $table->unsignedInteger('color_id')->nullable();
            $table->string('size')->nullable();
            $table->unsignedInteger('size_id')->nullable();
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('total');
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
        Schema::dropIfExists('product_sale_orders');
    }
};

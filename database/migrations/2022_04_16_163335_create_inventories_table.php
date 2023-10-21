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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
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
            $table->float('last_unit_price',50);
            $table->float('avg_unit_price',50);
            $table->float('selling_unit_price',50);
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
        Schema::dropIfExists('inventories');
    }
};

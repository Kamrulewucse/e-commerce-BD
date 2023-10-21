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
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->float('subtotal');
            $table->float('shipping_cost')->default(0);
            $table->float('vat')->default(0);
            $table->float('total');
            $table->float('paid')->default(0);
            $table->float('due')->default(0);
            $table->unsignedInteger('payment_method');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('alternative_mobile')->nullable();
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->longText('billing_address');
            $table->longText('shipping_address');
            $table->longText('notes')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('on_shipping_at')->nullable();
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('delivery_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->unsignedInteger('status');
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
        Schema::dropIfExists('sale_orders');
    }
};

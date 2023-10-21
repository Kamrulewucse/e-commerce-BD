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
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('description');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('state_id');
            $table->string('city')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('mobile_no_code_1')->nullable();
            $table->string('mobile_no_code_2')->nullable();
            $table->string('mobile_no_code_3')->nullable();
            $table->string('mobile_no_type_1')->nullable();
            $table->string('mobile_no_type_2')->nullable();
            $table->string('mobile_no_type_3')->nullable();
            $table->string('mobile_no_1')->nullable();
            $table->string('mobile_no_2')->nullable();
            $table->string('mobile_no_3')->nullable();
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
        Schema::dropIfExists('address_books');
    }
};

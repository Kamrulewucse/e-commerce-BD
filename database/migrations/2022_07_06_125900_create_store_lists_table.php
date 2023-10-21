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
        Schema::create('store_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('address');
            $table->longText('contact_number');
            $table->longText('service_detail');
            $table->longText('opening_hours');
            $table->longText('closing_days');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('sort');
            $table->boolean('status');
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
        Schema::dropIfExists('store_lists');
    }
};

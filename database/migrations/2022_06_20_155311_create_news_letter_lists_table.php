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
        Schema::create('news_letter_lists', function (Blueprint $table) {
            $table->id();
            $table->string('sub_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('country');
            $table->string('email');
            $table->string('verification_email');
            $table->string('privacy_policy');
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
        Schema::dropIfExists('news_letter_lists');
    }
};

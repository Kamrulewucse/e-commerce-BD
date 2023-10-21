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
        Schema::create('email_us', function (Blueprint $table) {
            $table->id();
            $table->string('name_title');
            $table->string('first_name');
            $table->string('email');
            $table->string('country');
            $table->string('number_prefix')->nullable();
            $table->integer('number')->nullable();
            $table->string('language');
            $table->string('subject_message');
            $table->integer('old_number')->nullable();
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('email_us');
    }
};

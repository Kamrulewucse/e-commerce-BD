<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('sale_order_type')->nullable()->comment('1=normal,2=ecommerce');
            $table->date('date');
            $table->string('particular');
            $table->tinyInteger('transaction_type')->comment('1=Income; 2=Expense');
            $table->tinyInteger('transaction_method')->comment('1=Cash; 2=Bank');
            $table->tinyInteger('account_head_type_id');
            $table->tinyInteger('account_head_sub_type_id');
            $table->unsignedInteger('bank_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('bank_account_id')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_image')->nullable();
            $table->float('amount', 20);
            $table->string('note')->nullable();
            $table->unsignedInteger('balance_transfer_id')->nullable();
            $table->unsignedInteger('transaction_id')->nullable();
            $table->unsignedInteger('sale_payment_id')->nullable();
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
        Schema::dropIfExists('transaction_logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transactionId');
            $table->string('transactionUserId');
            $table->string('transactionPostId');
            $table->string('transactionAction');
            $table->string('transactionAmount');
            $table->string('transactionPaymentType');
            $table->timestamp('transactionCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('transactionUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

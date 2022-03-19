<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('reviewId');
            $table->string('reviewUserId');
            $table->string('reviewImage')->nullable();
            $table->string('reviewType');
            $table->string('reviewStatus');
            $table->timestamp('reviewCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('reviewUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}

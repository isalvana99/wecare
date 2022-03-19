<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecactivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recactivities', function (Blueprint $table) {
            $table->bigIncrements('recactivityId');
            $table->string('recactivityBy');
            $table->string('recactivityUserId')->nullable();
            $table->string('recactivityPostId')->nullable();
            $table->string('recactivityAmount')->nullable();
            $table->timestamp('recactivityCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recactivities');
    }
}

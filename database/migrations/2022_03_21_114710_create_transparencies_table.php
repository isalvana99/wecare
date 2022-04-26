<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransparenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transparencies', function (Blueprint $table) {
            $table->bigIncrements('transparencyId');
            $table->string('transparencyUserId');
            $table->string('transparencyPostId');
            $table->string('transparencyLocation');
            $table->string('transparencyHouseholdUserId');
            $table->string('transparencyAmount');
            $table->timestamp('transparencyCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('transparencyUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transparencies');
    }
}

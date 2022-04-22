<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->bigIncrements('distributionId');
            $table->string('distributionUserId');
            $table->string('distributionAssignedTo');
            $table->string('distributionLocation');
            $table->string('distributionPostId');
            $table->string('distributionAmount');
            $table->timestamp('distributionCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('distributionUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('reportId');
            $table->string('reportedBy')->nullable();
            $table->string('reportUserId')->nullable();
            $table->string('reportPostId')->nullable();
            $table->string('reportCommentId')->nullable();
            $table->string('reportDescription');
            $table->string('reportStatus');
            $table->timestamp('reportCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('reportUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}

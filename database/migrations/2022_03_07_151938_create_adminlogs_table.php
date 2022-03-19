<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminlogs', function (Blueprint $table) {
            $table->bigIncrements('adminlogId');
            $table->string('adminloggedBy');
            $table->string('adminlogUserId')->nullable();
            $table->string('adminlogPostId')->nullable();
            $table->string('adminlogCommentId')->nullable();
            $table->string('adminlogDescription');
            $table->string('adminlogCategory');
            $table->timestamp('adminlogCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adminlogs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('fileId');
            $table->string('fileUserId');
            $table->string('filePostId');
            $table->string('fileName')->nullable();
            $table->string('filePath')->nullable();
            $table->timestamp('fileCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fileUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}

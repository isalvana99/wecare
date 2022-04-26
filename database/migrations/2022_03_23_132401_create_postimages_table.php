<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postimages', function (Blueprint $table) {
            $table->bigIncrements('postImageId');
            $table->string('postImageUserId');
            $table->string('postImagePostId');
            $table->string('postImageName')->nullable();
            $table->timestamp('postImageCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('postImageUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postimages');
    }
}

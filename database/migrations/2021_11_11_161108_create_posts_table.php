<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->string('postId')->primary();
            $table->string('postUserId');
            $table->mediumText('postCaption');
            $table->string('postStatus');
            $table->string('postSector');
            $table->string('postBarangay');
            $table->string('postCity');
            $table->string('postProvince');
            $table->string('postRegion');
            $table->string('postCategory');
            $table->double('postTargetAmount');
            $table->double('postReceivedAmount');
            $table->string('postLikes');
            $table->string('postCoverImage');
            $table->timestamp('postCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('postUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

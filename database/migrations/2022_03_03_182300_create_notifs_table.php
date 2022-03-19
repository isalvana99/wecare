<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifs', function (Blueprint $table) {
            $table->bigIncrements('notifId');
            $table->string('notifUserId');
            $table->string('notifToUserId');
            $table->string('notifType');
            $table->string('notifPostId')->nullable();
            $table->string('notifCommentId')->nullable();
            $table->string('notifStatus');
            $table->timestamp('notifCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('notifUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifs');
    }
}

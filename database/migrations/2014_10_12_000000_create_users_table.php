<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('orgName')->nullable();
            $table->string('birthday')->nullable();
            $table->string('sex')->nullable();
            $table->string('sector')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('region');
            $table->string('phoneNumber')->unique();
            $table->string('license')->nullable();
            $table->double('amountReceived');
            $table->double('amountGiven');
            $table->string('accountVerified');
            $table->string('accountType');
            $table->string('email')->unique();
            $table->timestamp('emailVerified')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('profileImage');
            $table->timestamp('accountCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('accountUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deletedusers', function (Blueprint $table) {
            $table->bigIncrements('deleteduserId');
            $table->string('deleteduserFirstName')->nullable();
            $table->string('deleteduserLastName')->nullable();
            $table->string('deleteduserMiddleName')->nullable();
            $table->string('deleteduserOrgName')->nullable();
            $table->string('deleteduserBirthday')->nullable();
            $table->string('deleteduserSex')->nullable();
            $table->string('deleteduserSector')->nullable();
            $table->string('deleteduserBarangay');
            $table->string('deleteduserCity');
            $table->string('deleteduserProvince');
            $table->string('deleteduserRegion');
            $table->string('deleteduserPhoneNumber')->unique();
            $table->string('deleteduserLicense')->nullable();
            $table->double('deleteduserAmountReceived');
            $table->double('deleteduserAmountGiven');
            $table->string('deleteduserAccountVerified');
            $table->string('deleteduserAccountType');
            $table->string('deleteduserEmail');
            $table->timestamp('deleteduserEmailVerified')->nullable();
            $table->string('deleteduserPassword');
            $table->string('deleteduserRole');
            $table->string('deleteduserProfileImage');
            $table->timestamp('deleteduserAccountCreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleteduserAccountUpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deletedusers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('iot_device_id')->nullable()->comment('Iot Device ID for the future device integration');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Owner user id');
            $table->unsignedBigInteger('user_expert_id')->nullable()->comment('user_expert_id is the employee id which is primary id of users table');
            $table->dateTime('in_datetime')->nullable()->comment('Duty start time');
            $table->dateTime('out_datetime')->nullable()->comment('Duty End time');
            $table->integer('is_paid_leave_record')->nullable()->comment('Leave but 100% attend as Paid Leave');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}

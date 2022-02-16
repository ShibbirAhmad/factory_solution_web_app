<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_id');
            $table->dateTime('start_datetime')->nullable()->comment('Leave Start Date');
            $table->dateTime('end_datetime')->nullable()->comment('Leave End Date');
            $table->string('days')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('status')->comment('1=Paid,2=Unpaid');
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
        Schema::dropIfExists('expert_leaves');
    }
}

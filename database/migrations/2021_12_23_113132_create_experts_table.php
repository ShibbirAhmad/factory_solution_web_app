<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('job_type')->default(1)->comment('1=Full Time,2=Part Time,3=Contractual');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nid')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->date('join_date')->nullable();
            $table->double('current_salary')->nullable();
            $table->double('per_hour_salary')->nullable();
            $table->double('bonus')->default(0);
            $table->double('total_salary')->default(0);
            $table->double('total_fine')->default(0);
            $table->double('total_paid')->default(0);
            $table->integer('status')->default(1)->comment('1 = active, 0= inactive');
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
        Schema::dropIfExists('experts');
    }
}

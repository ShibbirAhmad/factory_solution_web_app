<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('expert_id')->nullable()->comment('Task Assigned to.');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->double('unit_qty')->nullable()->comment('total unit quantity. ex: 200 yard');
            $table->dateTime('handover_date')->nullable();
            $table->longText('progress_note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->comment('Record created person id is created_by which is primary id of users table');
            $table->softDeletes();
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
        Schema::dropIfExists('order_progress');
    }
}

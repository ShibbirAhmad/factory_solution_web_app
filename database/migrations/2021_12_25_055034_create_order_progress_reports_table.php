<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProgressReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_progress_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('order_progress_id')->nullable();
            $table->unsignedBigInteger('department_id')->comment('Task handling by department');
            $table->unsignedBigInteger('expert_id')->comment('Task handling by');
            $table->integer('variant_id')->default(1)->comment(' variant = size,color id');
            $table->integer('task_qty')->default(1)->comment('Expected Qty');
            $table->integer('handover_qty')->default(1)->comment('task submitted Qty');
            $table->unsignedBigInteger('verified_by')->nullable()->comment('Progress Verified By');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('order_progress_reports');
    }
}

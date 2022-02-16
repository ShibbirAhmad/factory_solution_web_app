<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_id');
            $table->double('bonus')->nullable();
            $table->double('fine')->nullable();
            $table->double('amount');
            $table->unsignedBigInteger('payment_method_id');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('expert_salaries');
    }
}

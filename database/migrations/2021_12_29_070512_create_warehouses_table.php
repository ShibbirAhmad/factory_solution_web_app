<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('user_id is a merchant id');
            $table->unsignedBigInteger('created_by')->nullable()->comment('created_by is a user table primary id');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->integer('total_employee')->nullable();
            $table->integer('total_capacity')->nullable();
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
        Schema::dropIfExists('warehouses');
    }
}

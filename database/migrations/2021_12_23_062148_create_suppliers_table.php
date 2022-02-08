<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nid')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->default(1)->comment('1=Active,0=In-Active');
            $table->double('total_amount')->default(0)->comment('All Time Purchase Amount');
            $table->double('total_discount')->default(0)->comment('All Time Purchase Amount');
            $table->double('total_paid')->default(0)->comment('All Time Paid.');
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
        Schema::dropIfExists('suppliers');
    }
}

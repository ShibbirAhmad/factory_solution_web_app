<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->comment('item parent');
            $table->foreignId('variant_id')->comment('variant = M,L,XL,Red,Navy');
            $table->integer('except_qty');
            $table->integer('handover_qty')->default(0);
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
        Schema::dropIfExists('order_variants');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('user id to identify the owner');
            $table->unsignedBigInteger('client_id')->comment('sale client id ');
            $table->string('invoice_no');
            $table->double('total')->comment('total sales amount');
            $table->double('paid')->default(0);
            $table->double('discount')->default(0);
            $table->unsignedBigInteger('created_by')->comment('sale created by ');
            $table->text('note')->comment('sale note or agreement ');
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
        Schema::dropIfExists('sales');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique()->nullable();
            $table->string('supplier_invoice_no')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User id ref as purchaser');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('supplier_id used for track Supplier');
            $table->integer('qty')->default(0);
            $table->double('total')->default(0);
            $table->double('discount')->default(0);
            $table->text('note')->nullable();
            $table->double('paid')->default(0);
            $table->dateTime('payable_date')->nullable()->comment('Ex. Next 5days later payment date');
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
        Schema::dropIfExists('purchases');
    }
}

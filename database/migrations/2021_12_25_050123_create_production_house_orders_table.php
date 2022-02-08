<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionHouseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_house_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Production house owner users ref');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->integer('product_id')->nullable()->comment('Fabric handover as product');
            $table->integer('qty')->default(1)->comment('total amount of yard/meeter etc');
            $table->integer('expected_produce_amount')->default(1)->comment('Expected Produced Amount');
            $table->integer('final_delivered_amount')->default(0)->comment('Final Delivered Amount');
            $table->dateTime('start_datetime')->nullable()->comment('Order Start date time');
            $table->dateTime('end_datetime')->nullable()->comment('Order end date time');
            $table->unsignedBigInteger('created_by')->nullable()->comment('The user who created the record');
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
        Schema::dropIfExists('production_house_orders');
    }
}

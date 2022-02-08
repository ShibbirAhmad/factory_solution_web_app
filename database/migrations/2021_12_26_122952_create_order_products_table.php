<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained()->comment('ordered customer user_id');
            $table->unsignedBigInteger('production_house_id')->nullable()->comment('ordered customer user_id');
            $table->integer('cost_amount')->default(1)->nullable();
            $table->integer('mrp_amount')->default(1)->nullable();
            $table->integer('qty')->default(1)->nullable();
            $table->dateTime('in_datetime')->nullable();
            $table->longText('note')->nullable()->comment('Order Produced Stock in products details/note');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Record Created By ref user_id');
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
        Schema::dropIfExists('order_products');
    }
}

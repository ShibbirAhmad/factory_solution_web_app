<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique()->nullable()->comment('Order no should be unique');
            $table->unsignedBigInteger('prototype_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable()->comment('Units information, Yard/Meter/others');
            $table->unsignedBigInteger('product_id')->nullable()->comment('Product information');
            $table->string('title')->nullable()->comment('Ex. Shirt Production-2021');
            $table->dateTime('start_datetime')->nullable()->comment('Project starting date');
            $table->dateTime('end_datetime')->nullable()->comment('Project ending date');
            $table->integer('qty')->default(1)->comment('Total Received items for the production');
            $table->double('total')->default(0);
            $table->integer('expected_qty')->default(0)->comment('Ex. 500 Piece will be produce from this project.');
            $table->integer('produced_qty')->nullable();
            $table->double('produced_per_product_price')->default(0);
            $table->string("attachments")->nullable();
            $table->longText('order_agreements')->nullable()->comment('Order Agreements details');
            $table->integer('is_closed')->default(0)->comment('0=On-going,1=Closed,2=Hold');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Customer information from users table');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Order created by this user. and primary key of users table');
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
        Schema::dropIfExists('orders');
    }
}

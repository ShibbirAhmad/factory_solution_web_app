<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductQtyColumnAddAtTableProductionHouseOrderProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_house_order_progress', function (Blueprint $table) {
            $table->integer('product_qty')->default(0)->comment('Column will be treat as unit_qty')->after('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_house_order_progress', function (Blueprint $table) {
            $table->dropColumn(['product_qty']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttributeIdColumnAtTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders',function(Blueprint $table){
            $table->unsignedBigInteger('attribute_id')->comment('example= Size/Color wise production')->after('prototype_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders',function(Blueprint $table){
            $table->dropColumn(['attribute_id']);
        });
    }
}

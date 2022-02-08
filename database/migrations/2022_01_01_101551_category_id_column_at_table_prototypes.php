<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryIdColumnAtTablePrototypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prototypes',function(Blueprint $table){
           $table->unsignedBigInteger('category_id')->nullable()->comment('category id')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prototypes',function(Blueprint $table){
              $table->dropColumn('category_id');
        });
    }
}

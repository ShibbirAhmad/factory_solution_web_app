<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VariantIdColumnAtProductionHouseOrderProgressReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_house_order_progress_reports', function (Blueprint $table) {
            $table->renameColumn('qty','handover_qty')->comment('quantity receive from department expert');
            $table->unsignedBigInteger('variant_id')->comment('example: M,L,Red,Black wise production')->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_house_order_progress_reports', function (Blueprint $table) {
            $table->dropColumn(['variant_id']);
            $table->renameColumn('handover_qty','qty');
        });
    }
}

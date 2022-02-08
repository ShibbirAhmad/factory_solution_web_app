<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpertIdColumnAtTableCashbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashbooks', function (Blueprint $table) {
            $table->unsignedBigInteger('expert_id')->nullable()->comment('expert_id is a experts table primary id')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashbooks', function (Blueprint $table) {
            $table->dropColumn(['expert_id']);
        });
    }
}

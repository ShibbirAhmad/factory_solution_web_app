<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnUserIdToUserExpertIdAtTableExperts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->text('user_id')->comment('user_id is a merchant id.')->change();
            $table->unsignedBigInteger('user_expert_id')->nullable()->comment('expert id of experts table')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->dropColumn(['user_expert_id']);
        });
    }
}

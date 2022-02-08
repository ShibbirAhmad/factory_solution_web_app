<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrototypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prototypes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('title')->nullable();
            $table->integer('type')->default(1)->comment('1=Full Product,2=Collar,3=Front Part,4=Back Part, ');
            $table->foreignId('user_id')->nullable()->comment('Proto-Type By/ Designed By');
            $table->integer('total_used')->default(0);
            $table->integer('status')->default(0)->comment('0=Declined,1=Approved As Design is ok');
            $table->string('ref_attachment')->nullable()->comment('Any Demo Attachment to follow to design');
            $table->string('ref_link')->nullable()->comment('Any Demo ref link to follow to design');
            $table->text('note')->nullable()->comment('Details about Proto-Type');
            $table->text('verification_note')->nullable()->comment('Verification about Proto-Type');
            $table->dateTime('proto_type_verified_at')->nullable()->comment('Proto Type Verified At.');
            $table->unsignedBigInteger('created_by')->nullable()->comment('The user who created the record');
            $table->unsignedBigInteger('approved_by')->nullable()->comment('The user who created the record');
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
        Schema::dropIfExists('prototypes');
    }
}

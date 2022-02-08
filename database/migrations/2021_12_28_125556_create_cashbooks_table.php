<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbooks', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique()->nullable();
            $table->foreignId('purchase_id')->nullable()->constrained();
            $table->foreignId('supplier_id')->nullable()->constrained();
            $table->foreignId('order_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained()->comment('Customer user_id which is primary id of users table');
            $table->foreignId('payment_method_id')->nullable()->constrained()->comment('Cash/Bank/Mobile Banking etc');
            $table->double('amount')->default(0);
            $table->integer('qty')->default(0);
            $table->integer('isDiscount')->default(0)->comment('1=Discount Payment,0=Regular Payment');
            $table->string('reference')->nullable()->comment('Reference means trxId sometimes Cheque No');
            $table->integer('isExpense')->default(0)->comment('0=Income,1=Expense');
            $table->string('attachment')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->integer('is_salary_payment')->default(0)->comment('0=Purchase Payment,1=Salary Payment');
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->comment('Record created person id is created_by which is primary id of users table');
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
        Schema::dropIfExists('cashbooks');
    }
}

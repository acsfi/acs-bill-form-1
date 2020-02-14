<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrintedRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('printed_records', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bill_id');
            $table->string('name');
            $table->float('unpaid_previous_account', 8, 2);
            $table->float('total_fees_for_sy', 8, 2);
            $table->float('tuition_fee', 8, 2);
            $table->float('registration_fee', 8, 2);
            $table->float('others_books', 8, 2);
            $table->float('tuition_fee_as_of_value', 8, 2);
            $table->float('registration_fee_as_of_value', 8, 2);
            $table->float('books_as_of_value', 8, 2);
            $table->float('outstanding_balance', 8, 2);
            $table->float('amount_payable_for_this_month_value', 8, 2);
            $table->string('tuition_fee_as_of_month');
            $table->string('registration_fee_as_of_month');
            $table->string('books_as_of_month');
            $table->string('amount_payable_for_this_month');
            $table->integer('remarks_day');
            $table->string('remarks_month');
            $table->tinyInteger("grade_level")->nullable();
            $table->tinyInteger("print")->default(0);
            $table->string('uuid');
            $table->timestamps();
            $table->foreign('bill_id')->references('id')->on('bills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('printed_records');
    }
}

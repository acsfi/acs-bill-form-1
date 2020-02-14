<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('unpaid_previous_account');
            $table->integer('total_fees_for_sy');
            $table->integer('tuition_fee');
            $table->integer('registration_fee');
            $table->integer('others_books');
            $table->string('tuition_fee_as_of');
            $table->string('registration_fee_as_of');
            $table->string('books_as_of');
            $table->integer('outstanding_balance');
            $table->string('amount_payable_for_this_month_of');
            $table->integer('remarks_day');
            $table->string('remarks_month');
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
        //
        Schema::drop('bills');
    }
}

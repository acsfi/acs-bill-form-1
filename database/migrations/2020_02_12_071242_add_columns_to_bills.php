<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            //
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
        });
    }
}

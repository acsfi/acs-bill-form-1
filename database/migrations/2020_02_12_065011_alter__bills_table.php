<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBillsTable extends Migration
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
            $table->dropColumn('unpaid_previous_account');
            $table->dropColumn('total_fees_for_sy');
            $table->dropColumn('tuition_fee');
            $table->dropColumn('registration_fee');
            $table->dropColumn('others_books');
            $table->dropColumn('outstanding_balance');
            $table->renameColumn('tuition_fee_as_of', 'tuition_fee_as_of_month');
            $table->renameColumn('registration_fee_as_of', 'registration_fee_as_of_month');
            $table->renameColumn('books_as_of', 'books_as_of_month');
            $table->renameColumn('amount_payable_for_this_month_of', 'amount_payable_for_this_month');
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
        });
    }
}

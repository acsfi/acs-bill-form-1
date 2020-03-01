<?php

namespace App\Http\Controllers;
use App\bill;
use App\printed_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BillController extends Controller
{
    //
    public $timestamps = true;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view('welcome', ["title" => "Bill"]);
    }
    public function fetch_all_bills(Request $request)
    {
        $bills = bill::orderBy("updated_at", "desc");
        if ( strlen($request->filter_grade) > 0 )
        {
            $bills->where("grade_level", $request->filter_grade);
        }
        if ( strlen($request->search_name) > 0 )
        {
            $bills->where('name', 'LIKE', '%'.$request->search_name.'%');
        }
        $bills = $bills->get();
        echo json_encode($bills);
    }

    public function create_bill(Request $request)
    {
        DB::table("bills")->insert($request->all());
        echo json_encode($request->all());
    }

    public function get_bill(Request $request)
    {
        $id = $request->id;
        $bill = bill::where("id", $id)->first();
        echo json_encode($bill);
    }
    public function update_bill(Request $request)
    {
        $id = $request->id;
        DB::table("bills")
            ->where("id", $id)
            ->update($request->all());
        echo json_encode($request->all());
    }
    public function print_bills(Request $request)
    {
        $bills = bill::all();
        foreach ($bills as $bill)
        {
            $bill->print = 0;
            $bill->save();
        }
        $ids = explode(",", $request->ids);
        for ($i=1; $i <= count($ids); $i++)
        {
            $date = date("Y-m-d H:i:s");
            DB::table("bills")
                ->where("id", $ids[$i-1])
                ->update(["print" => $i]);
        }
        $data["ids"] = $ids;
        $data["url"] = "http://acs.bill.form/print-page";
        echo json_encode($data);
    }
    public function print_page()
    {
        $bills = bill::where("print", "!=", 0)->orderBy("print", "asc")->get();
        $data = [
            "title" => "Print",
            "bills" => $bills
        ];
        echo json_encode($data);
    }
    public function records_save(Request $request)
    {
        $get_bills = bill::whereIn("id", $request->ids)->get();
        foreach ($get_bills as $get_bill)
        {
            $record_bill = new printed_record;
            $record_bill->bill_id = $get_bill->id;
            $record_bill->name = $get_bill->name;
            $record_bill->unpaid_previous_account = $get_bill->unpaid_previous_account;
            $record_bill->total_fees_for_sy = $get_bill->total_fees_for_sy;
            $record_bill->tuition_fee = $get_bill->tuition_fee;
            $record_bill->registration_fee = $get_bill->registration_fee;
            $record_bill->others_books = $get_bill->others_books;
            $record_bill->tuition_fee_as_of_value = $get_bill->tuition_fee_as_of_value;
            $record_bill->registration_fee_as_of_value = $get_bill->registration_fee_as_of_value;
            $record_bill->books_as_of_value = $get_bill->books_as_of_value;
            $record_bill->outstanding_balance = $get_bill->outstanding_balance;
            $record_bill->amount_payable_for_this_month_value = $get_bill->amount_payable_for_this_month_value;
            $record_bill->tuition_fee_as_of_month = $get_bill->tuition_fee_as_of_month;
            $record_bill->registration_fee_as_of_month = $get_bill->registration_fee_as_of_month;
            $record_bill->books_as_of_month = $get_bill->books_as_of_month;
            $record_bill->amount_payable_for_this_month = $get_bill->amount_payable_for_this_month;
            $record_bill->remarks_day = $get_bill->remarks_day;
            $record_bill->remarks_month = $get_bill->remarks_month;
            $record_bill->grade_level = $get_bill->grade_level;
            $record_bill->print = $get_bill->print;
            $record_bill->uuid = $request->uuid;
            $record_bill->save();
        }
        echo json_encode($get_bills);
    }
}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{$title}}</title>
        <script src="{{secure_asset('js/vue.min.js')}}"></script>
        <script src="{{secure_asset('js/jquery.js')}}"></script>
        <link href="{{secure_asset('css/app.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato|Quicksand|Raleway&display=swap" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <div class="header">
                <div>
                    <label for="filter-grade-level">Filter by Grade Level: </label>
                    <select class="select-css" name="filter-grade-level" id="filter-grade-level"  v-on:change="GetBill">
                        <option v-for="grade in grades" v-bind:value="grade.value"> @{{ grade.text }}</option>
                    </select>
                </div>
                <div>
                    <label for="search-name">Search </label>
                    <input type="text" id="search-name" class="name-validation name-input" placeholder="Name"/>
                </div>
                <div><button v-on:click="AddStudent">@{{ add_student_msg }}</button></div>
            </div>
            <div v-if="Tip">
                @{{ tip_message }}
            </div>
            <br>
        <div class="whole">
            {{-- List Student BIll --}}
            <div v-if="List" class="list" v-for="Bill in Bills">
                <div class="bills-btns">
                    <div>@{{ Bill.name }}</div>
                    <div>Grade: @{{ Bill.grade_level }}</div>
                    <div><button v-on:click="EditBill(Bill.id)" class="edit-bill">Edit</button></div>
                    <div><button v-on:click="AddToPrint(Bill.id)" class="add-to-print">Add to Print</button></div>
                    <div><button v-on:click="PreviewBill(Bill.id)">Preview</button></div>
                </div>
                <div class="data">
                    <div>
                        <div>Unpaid Previous Account: </div>
                        <div>Total fees for SY: </div>
                        <div>Tuition fee:  </div>
                        <div>Registration fee:  </div>
                        <div>Others...Books:  </div>
                        <div>Tuition fee as of @{{ Bill.tuition_fee_as_of_month }}:</div>
                    </div>
                    <div>
                        <div>&#8369; @{{ Bill.unpaid_previous_account }}</div>
                        <div>&#8369; @{{ Bill.total_fees_for_sy }}</div>
                        <div>&#8369; @{{ Bill.tuition_fee }}</div>
                        <div>&#8369; @{{ Bill.registration_fee }}</div>
                        <div>&#8369; @{{ Bill.others_books }}</div>
                        <div>&#8369; @{{ Bill.tuition_fee_as_of_value }}</div>
                    </div>
                    <div>
                        <div>Registration fee as of @{{ Bill.registration_fee_as_of_month }}:</div>
                        <div>Books fee as of @{{ Bill.books_as_of_month }}:</div>
                        <div>Outstanding Balance:</div>
                        <div>Amount Payable for this Month of @{{ Bill.amount_payable_for_this_month }}:</div>
                        <div>Remarks Day: </div>
                        <div>Remarks Month: </div>
                    </div>
                    <div>
                        <div>&#8369; @{{ Bill.registration_fee_as_of_value }}</div>
                        <div>&#8369; @{{ Bill.books_as_of_value }}</div>
                        <div>&#8369; @{{ Bill.outstanding_balance }}</div>
                        <div>&#8369; @{{ Bill.amount_payable_for_this_month_value }}</div>
                        <div>@{{ Bill.remarks_day }}</div>
                        <div>@{{ Bill.remarks_month }}</div>
                    </div>
                </div>
            </div>
            {{-- End List Student BIll --}}

            {{-- Add Student Bill --}}
            <div v-if="Add" class="add-student-form">
                <div class="form-div">
                <div>
                    <div><label for="grade-level">Grade Level:</label></div>
                    <div class="answer">
                        <select class="select-css" name="grade-level" id="grade-level">
                        <option v-for="grade in grades" :selected="Edit.grade_level == grade.value" v-bind:value="grade.value"> @{{ grade.text }}</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div><label for="name">Student Name:</label></div>
                    <div>

                        <input class="form-validate answer name-input" type="text" id="name" {{-- v-bind:value="bill_obj.name" --}} v-model="bill_obj.name" placeholder="Student Name"/>
                    </div>
                </div>
                <div class="div-two-columns">
                <div>
                    <div>
                        <label for="u-p-a">Unpaid Previous Account</label>
                    </div>
                    <div>
                        <input :disabled="bill_obj.name" class="form-validate number-only answer" type="text" id="u-p-a" {{-- v-bind:value="Edit.unpaid_previous_account" --}} v-model="Edit.unpaid_previous_account" v-on:keyup="Edit_upa" />
                    </div>
                </div>
                <div>
                    <div>
                        <label for="t-f-f-s">Total Fees For S-Y</label>
                    </div>
                    <div>
                        <input disabled class="form-validate number-only" type="text" class="" id="t-f-f-s" readonly v-model="Edit.total_fees_for_sy" v-on:keyup="Edit_tffsy"/>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="t-f">Tuition Fee</label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="t-f" {{-- v-bind:value="Edit.tuition_fee" --}} v-model="Edit.tuition_fee" v-on:keyup="Edit_tf"/>
                    </div>
                </div>
                {{-- <div>
                    <div>
                        <label for="r-f">Registration Fee</label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="r-f" v-model="Edit.registration_fee" v-on:keyup="Edit_rf"/>
                    </div>
                </div> --}}
                <div>
                    <div class="as-of-divs">
                        <label for="tfao_month">
                            Tuition fee as of &nbsp;
                            <select class="select-css" id="tfao_month" v-model="bill_obj.tuition_fee_as_of_month">
                                <option v-for="month in months" :selected="Edit.tuition_fee_as_of_month == month.value" v-bind:value="month.value"> @{{ month.text }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div>

                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="tfao_value" v-on:keyup="Edit_tfao" v-model="Edit.tuition_fee_as_of_value"/>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="r-f">Registration Fee</label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="r-f" v-model="Edit.registration_fee" v-on:keyup="Edit_rf"/>
                    </div>
                </div>
                <div>
                    <div class="as-of-divs">
                        <label for="rfao_month">Registration fee as of &nbsp;
                            <select class="select-css" id="rfao_month" v-model="bill_obj.registration_fee_as_of_month">
                                <option v-for="month in months" :selected="Edit.registration_fee_as_of_month == month.value" v-bind:value="month.value"> @{{ month.text }}</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="rfao_value" v-on:keyup="Edit_rfao" v-model="Edit.registration_fee_as_of_value"/>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="o-b">Other Books</label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="o-b" v-model="Edit.others_books" v-on:keyup="Edit_ob"/>
                    </div>
                </div>
                <div>
                    <div class="as-of-divs">
                        <label for="bao_month">
                            Books fee as of &nbsp;
                            <select class="select-css" class="select-css" id="bao_month" v-model="bill_obj.books_as_of_month">
                                <option v-for="month in months" :selected="Edit.books_as_of_month == month.value" v-bind:value="month.value"> @{{ month.text }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="bao_value"
                        {{-- v-bind:value="Edit.books_as_of_value" --}} v-on:keyup="Edit_bao" v-model="Edit.books_as_of_value"/>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="outstanding-balance">Outstanding Balance</label>
                    </div>
                    <div>
                        <input class="form-validate number-only" type="text" id="outstanding-balance" v-on:keyup="Edit_outb" v-model="Edit.outstanding_balance"/>
                    </div>
                </div>

                </div>{{-- End two-divs-columns --}}
                <div>
                    <div class="as-of-divs">
                        <label for="apftmo_month">Amount Payable for this Month of &nbsp;
                            <select class="select-css" id="apftmo_month" v-model="bill_obj.amount_payable_for_this_month">
                                <option v-for="month in months" :selected="Edit.amount_payable_for_this_month == month.value" v-bind:value="month.value">
                                     @{{ month.text }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <input class="form-validate number-only answer" type="text" id="apftmo_value" v-on:keyup="Edit_apftm" v-model="Edit.amount_payable_for_this_month_value" />
                    </div>
                </div>
                <div class="div-two-columns">
                    <div>
                        <div>
                            <label for="remarks_day">Remarks Day</label>
                        </div>
                        <div>
                            <input class="form-validate number-only" type="text" id="remarks_day" v-on:keyup="Edit_rd"  v-model="Edit.remarks_day"/>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="remarks_month">Remarks Month</label>
                        </div>
                        <div>
                            <select class="select-css remarks-month" id="remarks_month" v-model="bill_obj.remarks_month">
                                <option v-for="month in months" :selected="Edit.remarks_month == month.value" v-bind:value="month.value"> @{{ month.text }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="margin-auto-auto">
                        <div>
                            <button class="button close-btn" v-on:click="CloseAddStudent">Close</button>
                        </div>
                    </div>
                    <div class="margin-auto-auto">
                        <button class="button create-btn" type="submit" v-bind:data-id="(Edit.id ? Edit.id : '')" v-bind:id="(Edit.id ? 'update-student-bill-btn' : 'create-student-bill-btn')" :disabled="(Edit.id ? false : true)">
                            @{{ create_student_msg }}
                        </button>
                        {{-- <div class="margin-auto-auto">
                            <div  id="complete-form-msg">@{{ complete_form_msg }}</div>
                        </div> --}}


                    </div>

                </div>
                </div>
            </div>



            {{-- End of Add Student Bill --}}

            {{-- Start Add To Print Preview --}}
            <div v-if="preview_print" class="add-to-print-preview" id="print">
                <div v-for="(addprint, index) in addprints" class="add-print">
                    <div class="add-print-div">
                        <div class="bill-form-header">
                            <div>ACS BILLING FORM No.01</div>
                            <div style="text-indent: 7.5%;">AURORA CHRISTIAN SCHOOL FOUNDATION</div>
                            <div style="text-indent: 15%;">Bambang, Nueva Vizcaya</div>
                        </div>
                        <div class="bill-form-date" style="margin: 1.5% 5% 0 auto;">
                            Date: @{{ bill_date }}
                        </div>
                        <div style="margin-top: 1.5%">
                            Dear Parents/Guardian of <b>@{{ addprint.name }}</b>, below is a statement of accounts of your child for the school year <b>@{{ school_year }}</b>.
                        </div>
                        <div style="margin-top: 3%">
                            Unpaid Previous Account.....................&#8369; @{{ addprint.unpaid_previous_account }}
                        </div>
                        <div style="margin-top: 3%">
                        <b>Add:</b>
                        <span style="display:inline-block; text-indent:7%; width: 80%;">
                            Total Fees for S.Y ............ &#8369; @{{ addprint.total_fees_for_sy }}
                        </span>
                        </div>
                        <div style="text-indent: 15%">
                            Tuition Fee ......................... &#8369; @{{ addprint.tuition_fee }}
                        </div>
                        <div style="text-indent: 15%">
                            Registration Fee ............. &#8369; @{{ addprint.registration_fee }}
                        </div>
                        <div style="text-indent: 15%">
                            Others...Books ................. &#8369; @{{ addprint.others_books }}
                        </div>
                        <div>
                            <b>Less:</b>
                            <span>Payments made for:</span>
                        </div>
                        <div style="text-indent:15%">
                            Tuition Fee as of @{{ addprint.tuition_fee_as_of_month }}:
                            &#8369; @{{ addprint.tuition_fee_as_of_value }}
                        </div>
                        <div style="text-indent:15%">
                            Registration Fee as of @{{ addprint.registration_fee_as_of_month }}:
                            &#8369; @{{ addprint.registration_fee_as_of_value }}
                        </div>
                        <div style="text-indent:15%">
                            Books Fee as of @{{ addprint.books_as_of_month }}: &#8369;
                            @{{ addprint.books_as_of_value }}
                        </div>
                        <div>
                            Outstanding Balance .......................
                            &#8369; @{{ addprint.outstanding_balance }}
                        </div>
                        <div>
                            Amount Payable for this month of @{{ addprint.amount_payable_for_this_month }}:
                            &#8369; @{{ addprint.amount_payable_for_this_month_value }}
                        </div>
                        <div style="margin-top: 3%">
                            <b>Remarks:</b>
                        </div>
                        <div style="text-indent: 7.5%">
                            We would appreciate very much if you could settle the
                            amount on or before the
                            <b>@{{ addprint.remarks_day }}</b> day of
                            <b>@{{ addprint.remarks_month }}</b>.
                            Please remit your payment to the school cashier.
                        </div>
                        <div class="cashier-signature">
                            <div><b>Rowena B. Domingo</b></div>
                            <div>Cashier</div>
                        </div>
                        <div style="margin-top: 3%">
                            <b>Note: </b>
                            Please bring this reminder upon payment. Should you
                            need further clarification of the above statement, please feel
                            to come to our office. Thank you.
                        </div>
                    </div>
                    <div class="remove-print-btn" v-on:click="RemovePrint(index)">&#x274C;</div>
                </div>
            </div>
            {{-- End Add To Print Preview --}}
            {{-- Start Preview Bill --}}
            <div v-if="preview_bill" class="preview-bill">
                <div>
                    <div class="bill-form-header">
                        <div>ACS BILLING FORM No.01</div>
                        <div style="text-indent: 7.5%;">AURORA CHRISTIAN SCHOOL FOUNDATION</div>
                        <div style="text-indent: 15%;">Bambang, Nueva Vizcaya</div>
                    </div>
                    <div class="bill-form-date" style="margin: 1.5% 5% 0 auto;">
                        Date: @{{ bill_date }}
                    </div>
                    <div style="margin-top: 1.5%">
                        Dear Parents/Guardian of <b>@{{ bill_obj.name }}</b>, below is a statement of accounts of your child for the school year <b>@{{ school_year }}</b>.
                    </div>
                    <div style="margin-top: 3%">
                        Unpaid Previous Account.....................&#8369; @{{ bill_obj.unpaid_previous_account }}
                    </div>
                    <div style="margin-top: 3%">
                    <b>Add:</b>
                    <span style="display:inline-block; text-indent:7%; width: 80%;">
                        Total Fees for S.Y ............ &#8369; @{{ bill_obj.total_fees_for_sy }}
                    </span>
                    </div>
                    <div style="text-indent: 15%">
                        Tuition Fee ......................... &#8369; @{{ bill_obj.tuition_fee }}
                    </div>
                    <div style="text-indent: 15%">
                        Registration Fee ............. &#8369; @{{ bill_obj.registration_fee }}
                    </div>
                    <div style="text-indent: 15%">
                        Others...Books ................. &#8369; @{{ bill_obj.others_books }}
                    </div>
                    <div style="margin-top: 3%">
                        <b>Less:</b>
                        <span>Payments made for:</span>
                    </div>
                    <div style="text-indent:15%">
                        Tuition Fee as of @{{ bill_obj.tuition_fee_as_of_month }}:
                        &#8369; @{{ bill_obj.tuition_fee_as_of_value }}
                    </div>
                    <div style="text-indent:15%">
                        Registration Fee as of @{{ bill_obj.registration_fee_as_of_month }}:
                        &#8369; @{{ bill_obj.registration_fee_as_of_value }}
                    </div>
                    <div style="text-indent:15%">
                        Books Fee as of @{{ bill_obj.books_as_of_month }}: &#8369;
                        @{{ bill_obj.books_as_of_value }}
                    </div>
                    <div style="margin-top: 3%">
                        Outstanding Balance .......................
                        &#8369; @{{ bill_obj.outstanding_balance }}
                    </div>
                    <div>
                        Amount Payable for this month of @{{ bill_obj.amount_payable_for_this_month }}:
                        &#8369; @{{ bill_obj.amount_payable_for_this_month_value }}
                    </div>
                    <div style="margin-top: 3%">
                        <b>Remarks:</b>
                    </div>
                    <div style="text-indent: 7.5%">
                        We would appreciate very much if you could settle the
                        amount on or before the
                        <b>@{{ bill_obj.remarks_day }}</b> day of
                        <b>@{{ bill_obj.remarks_month }}</b>.
                        Please remit your payment to the school cashier.
                    </div>
                    <div class="cashier-signature">
                        <div><b>Rowena B. Domingo</b></div>
                        <div>Cashier</div>
                    </div>
                    <div style="margin-top: 3%">
                        <b>Note: </b>
                        Please bring this reminder upon payment. Should you
                        need further clarification of the above statement, please feel free to come to our office. Thank you.
                    </div>
                </div>
            </div>
            {{-- End Preview Bill --}}
            {{-- Sticky Footer Buttons --}}
            <div class="footer-buttons">
                {{-- <div><button v-on:click="PreviewPrint">Preview Print</button></div> --}}
                <div><button :disabled="(addprints.length > 0 ? false : true)" v-on:click="Print">Print</button></div>
            </div>
            {{-- End Sticky Footer Buttons --}}

        </div> {{-- whole close --}}
        </div>{{-- app close --}}


    </body>


    <script src="{{secure_asset('js/vue/functions.js')}}"></script>
    <script src="{{secure_asset('js/vue/events.js')}}"></script>
    <script src="{{secure_asset('js/vue/app.js')}}"></script>



</html>

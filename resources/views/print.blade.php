<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{$title}}</title>
        <script src="{{asset('js/vue.min.js')}}"></script>
        <script src="{{asset('js/jquery.js')}}"></script>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    </head>

    <style type="text/css">
        body {
            background: rgb(204,204,204);
        }
        page[size="long"] {
        background: white;
        width: 8.5in;
        height: 13in;
        display: block;
        margin: 0 auto;
        /* margin-bottom: 0.5cm; */
        box-shadow: 0 0 0.1in rgba(0,0,0,0.5);
        display:grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);

        font-family: 'Source Sans Pro', sans-serif;
        font-size:10pt;
        }
        @media print {
            body, page[size="long"] {
                margin: 0;
                box-shadow: 0;
            }
        }
        page > div {
            margin: 0.3in 0.3in 0.3in 0.3in;
            display: grid;
            grid-auto-rows: auto;
        }
        .cashier-signature {
            display:grid;
            margin: 0% 3% 0 auto;
            grid-template-rows: repeat(2,1fr);
        }
        .cashier-signature > div {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .three-divs {
            display: grid;
            grid-template-columns: 50px 220px auto;
        }
        .two-divs {
            display: grid;
            grid-template-columns: 270px 1fr;
        }
        .bill-form-date {
            margin: 1.5% 5% 0 auto;
        }
        .bill-form-values {
            margin: 0 auto 0 0;
        }
        .bill-form-keys {
            overflow: hidden;
            white-space: nowrap;
        }
        .save-records-div {
            right: 1.5%;
            top: 20%;
            width: 20%;
            position: fixed;
            display: grid;
            grid-auto-rows: minmax(20px,auto);
        }
        .save-records-div > .list {
            margin: 0 auto 0 1%;
        }
    </style>
    <body>
    <div id="app">
        <page size="long">
            <div v-if="printables.length > 0" v-for="print_now in printables">
                <div class="bill-form-header">
                    <div>ACS BILLING FORM No.01</div>
                    <div style="text-indent: 7.5%;">AURORA CHRISTIAN SCHOOL FOUNDATION</div>
                    <div style="text-indent: 15%;">Bambang, Nueva Vizcaya</div>
                </div>
                <div class="bill-form-date">
                    Date: @{{ bill_date }}
                </div>
                <div {{-- style="margin-top: 1.5%" --}}>
                    Dear Parents/Guardian of <b>@{{ print_now.name }}</b>, below is a statement of accounts of your child for the school year <b>@{{ school_year }}</b>.
                </div>
                <div class="two-divs" style="margin-top: 5px">
                    <div class="bill-form-keys">
                        Unpaid Previous Account ..............................................................................................................................................................................................................................................
                    </div>
                    <div>
                        &#8369; @{{ print_now.unpaid_previous_account }}
                    </div>
                </div>
                <div class="three-divs"{{-- style="margin-top: 1.5%" --}}>
                <div><b>Add:</b></div>
                {{-- <span style="display:inline-block; text-indent:7%; width: 80%;"> --}}
                    <div class="bill-form-keys">
                        Total Fees for S.Y ..............................................................................................................................................................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.total_fees_for_sy }}
                    </div>
                {{-- </span> --}}
                </div>
                <div class="three-divs"{{-- style="text-indent: 15%" --}}>
                    <div></div>
                    <div class="bill-form-keys">
                        Tuition Fee ....................................................................................................................................................................................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.tuition_fee }}
                    </div>
                </div>
                <div class="three-divs"{{-- style="text-indent: 15%" --}}>
                    <div></div>
                    <div class="bill-form-keys">
                        Registration Fee ..................................................................................................................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.registration_fee }}
                    </div>
                </div>
                <div class="three-divs"{{-- style="text-indent: 15%" --}}>
                    <div></div>
                    <div class="bill-form-keys">
                        Others...Books ....................................................................................................................................................................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.others_books }}
                    </div>
                </div>
                <div class="three-divs"{{-- style="margin-top: 1.5%" --}}>
                    <div><b>Less:</b></div>
                    <div><span>Payments made for:</span></div>
                    <div></div>
                </div>
                <div class="three-divs"{{-- style="text-indent:15%" --}}>
                    <div></div>
                    <div class="bill-form-keys">
                        Tuition Fee as of @{{ print_now.tuition_fee_as_of_month }} .................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.tuition_fee_as_of_value }}
                    </div>
                </div>
                <div class="three-divs"{{-- style="text-indent:15%" --}}>
                    <div></div>
                    <div class="bill-form-keys">
                        Registration Fee as of @{{ print_now.registration_fee_as_of_month }} .................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.registration_fee_as_of_value }}
                    </div>
                </div>
                <div class="three-divs"{{-- style="text-indent:15%" --}}>
                    <div></div>
                    <div class="bill-form-keys">
                        Books Fee as of @{{ print_now.books_as_of_month }} .................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.books_as_of_value }}
                    </div>
                </div>
                <div class="two-divs"{{-- style="margin-top: 1.5%" --}}>
                    <div class="bill-form-keys">
                        Outstanding Balance .....................................................................................................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.outstanding_balance }}
                    </div>
                </div>
                <div class="two-divs">
                    <div class="bill-form-keys">
                        Amount Payable for this month of @{{ print_now.amount_payable_for_this_month }} ...............................................................................
                    </div>
                    <div class="bill-form-values">
                        &#8369; @{{ print_now.amount_payable_for_this_month_value }}
                    </div>
                </div>
                <div {{-- style="margin-top: 1.5%" --}}>
                    <b>Remarks:</b>
                </div>
                <div style="text-indent: 7.5%">
                    We would appreciate very much if you could settle the
                    amount on or before the
                    <b>@{{ print_now.remarks_day }}</b> day of
                    <b>@{{ print_now.remarks_month }}</b>.
                    Please remit your payment to the school cashier.
                </div>
                <div class="cashier-signature">
                    <div><b>Rowena B. Domingo</b></div>
                    <div>Cashier</div>
                </div>
                <div {{-- style="margin-top: 1.5%" --}}>
                    <b>Note: </b>
                    Please bring this reminder upon payment. Should you
                    need further clarification of the above statement, please feel free to come to our office. Thank you.
                </div>
            </div>
        </page>
    </div>
    </body>

    <script src="{{asset('js/vue/functions.js')}}"></script>
    <script src="{{asset('js/vue/events.js')}}"></script>
    <script src="{{asset('js/vue/app.js')}}"></script>

</html>

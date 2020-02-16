function activate_btn_student_bill(bool)
{
    if (bool == 1)
    {
        $("#create-student-bill-btn").removeAttr("disabled");
        $("#complete-form-msg").hide();
    }
    else
    {
        $("#create-student-bill-btn").attr("disabled","disabled");
        $("#complete-form-msg").show();
    }
}

function create_student_bill(data)
{
    $.ajax({
        data: data,
        method: "POST",
        url: "/create/bill",
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success:function(data){
            nData = JSON.parse(data);
            app.GetBill();
            app.CloseAddStudent();
        }
    });
}
function update_student_bill(data)
{
    $.ajax({
        data: data,
        type: "POST",
        url: "/update/bill/" + data["id"],
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success:function(data){
            nData = JSON.parse(data);
            app.GetBill();
            app.CloseAddStudent();
        }
    });
}

function timestamp()
{
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    return dateTime = date+' '+time;
}


function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 110 || charCode == 190 || charCode >= 96 && charCode <= 105) return true;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function noRecordFound()
{
    app.List = false;
    app.Tip = true;
    app.tip_message = "No Record Found";
}


function GetSchoolYear()
{
    let this_date = new Date;
    let ret_value;
    if (this_date.getMonth() < 4)
    {
        let sub_year = this_date.getFullYear() - 1;
        ret_value =  sub_year + '-' + this_date.getFullYear();
    }
    else if (this_date.getMonth() > 5)
    {
        let add_year = this_date.getFullYear() + 1;
        ret_value = this_date.getFullYear() + '-' + add_year;
    }
    return ret_value;
}

function Check_Remarks_Day(data)
{
    if (Array.isArray(data))
    {
        var new_data = [];
        data.forEach((e) => {
            e.grade_level = grade_level(e.grade_level);
            let rm_arr = e.remarks_day.toString().split("");
            e.unpaid_previous_account = numberWithCommas(financial(e.unpaid_previous_account));
            e.total_fees_for_sy = numberWithCommas(financial(e.total_fees_for_sy));
            e.tuition_fee = numberWithCommas(financial(e.tuition_fee));
            e.registration_fee = numberWithCommas(financial(e.registration_fee));
            e.others_books = numberWithCommas(financial(e.others_books));
            e.tuition_fee_as_of_value = numberWithCommas(financial(e.tuition_fee_as_of_value));
            e.registration_fee_as_of_value = numberWithCommas(financial(e.registration_fee_as_of_value));
            e.books_as_of_value = numberWithCommas(financial(e.books_as_of_value));
            e.outstanding_balance = numberWithCommas(financial(e.outstanding_balance));
            e.amount_payable_for_this_month_value = numberWithCommas(financial(e.amount_payable_for_this_month_value));
            // console.log(rm_arr.length);
            if (rm_arr.length == 1)
            {
                switch (parseInt(rm_arr[0]))
                {
                    case 1:
                    e.remarks_day = e.remarks_day + "st";
                    break;
                    case 2:
                    e.remarks_day = e.remarks_day + "nd";
                    break;
                    case 3:
                    e.remarks_day = e.remarks_day + "rd";
                    break;
                    default :
                    e.remarks_day = e.remarks_day + "th";
                    break;
                }
            }
            else
            {
                if ( parseInt(rm_arr[0]) <= 3 && parseInt(rm_arr[0]) > 1 && parseInt(rm_arr[1]) == 1)
                {
                    e.remarks_day = e.remarks_day + "st";
                }
                else if ( parseInt(rm_arr[0]) <= 3 && parseInt(rm_arr[0]) > 1 && parseInt(rm_arr[1]) == 2)
                {
                    e.remarks_day = e.remarks_day + "nd";
                }
                else if ( parseInt(rm_arr[0]) <= 3 && parseInt(rm_arr[0]) > 1 && parseInt(rm_arr[1]) == 3)
                {
                    e.remarks_day = e.remarks_day + "rd";
                }
                else
                {
                    e.remarks_day = e.remarks_day + "th";
                }
            }
        });
        new_data = data;
        return new_data;
    }
    else
    {
        var new_data = {};
        data.grade_level = grade_level(data.grade_level);
        let rm_arr = data.remarks_day.toString().split("");
        data.unpaid_previous_account = numberWithCommas(financial(data.unpaid_previous_account));
        data.total_fees_for_sy = numberWithCommas(financial(data.total_fees_for_sy));
        data.tuition_fee = numberWithCommas(financial(data.tuition_fee));
        data.registration_fee = numberWithCommas(financial(data.registration_fee));
        data.others_books = numberWithCommas(financial(data.others_books));
        data.tuition_fee_as_of_value = numberWithCommas(financial(data.tuition_fee_as_of_value));
        data.registration_fee_as_of_value = numberWithCommas(financial(data.registration_fee_as_of_value));
        data.books_as_of_value = numberWithCommas(financial(data.books_as_of_value));
        data.outstanding_balance = numberWithCommas(financial(data.outstanding_balance));
        data.amount_payable_for_this_month_value = numberWithCommas(financial(data.amount_payable_for_this_month_value));
            // console.log(rm_arr.length);
            if (rm_arr.length == 1)
            {
                switch (parseInt(rm_arr[0]))
                {
                    case 1:
                    data.remarks_day = data.remarks_day + "st";
                    break;
                    case 2:
                    data.remarks_day = data.remarks_day + "nd";
                    break;
                    case 3:
                    data.remarks_day = data.remarks_day + "rd";
                    break;
                    default :
                    data.remarks_day = data.remarks_day + "th";
                    break;
                }
            }
            else
            {
                if ( parseInt(rm_arr[0]) <= 3 && parseInt(rm_arr[0]) > 1 && parseInt(rm_arr[1]) == 1)
                {
                    data.remarks_day = data.remarks_day + "st";
                }
                else if ( parseInt(rm_arr[0]) <= 3 && parseInt(rm_arr[0]) > 1 && parseInt(rm_arr[1]) == 2)
                {
                    data.remarks_day = data.remarks_day + "nd";
                }
                else if ( parseInt(rm_arr[0]) <= 3 && parseInt(rm_arr[0]) > 1 && parseInt(rm_arr[1]) == 3)
                {
                    data.remarks_day = data.remarks_day + "rd";
                }
                else
                {
                    data.remarks_day = data.remarks_day + "th";
                }
            }
            new_data = data;
            return new_data;
    }

}

const numberWithCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function grade_level(data)
{
    if (data == 0) return "N";
    if (data == 1) return "K-1";
    if (data == 2) return "K-2";
    if (data == 3) return "G-1";
    if (data == 4) return "G-2";
    if (data == 5) return "G-3";
    if (data == 6) return "G-4";
    if (data == 7) return "G-5";
    if (data == 8) return "G-6";
    if (data == null) return "?";
}

function get_ordinal(number)
{
    let num = number.toString().split("");
    if (num.length == 1)
    {
        switch (parseInt(num[0]))
        {
            case 1:
            number = number + "st";
            break;
            case 2:
            number = number + "nd";
            break;
            case 3:
            number = number + "rd";
            break;
            default :
            number = number + "th";
            break;
        }
    }
    else
    {
        if ( parseInt(num[0]) <= 3 && parseInt(num[0]) > 1 && parseInt(num[1]) == 1)
        {
            number = number + "st";
        }
        else if ( parseInt(num[0]) <= 3 && parseInt(num[0]) > 1 && parseInt(num[1]) == 2)
        {
            number = number + "nd";
        }
        else if ( parseInt(num[0]) <= 3 && parseInt(num[0]) > 1 && parseInt(num[1]) == 3)
        {
            number = number + "rd";
        }
        else
        {
            number = number + "th";
        }
    }
    return number;
}

function Days() {
    let days = [];
    for( var i = 1; i <= 31; i++)
    {
        let obj = { text: get_ordinal(i), value: i};
        days.push(obj);
    }
    return days;
}


function financial(x) {
    return Number.parseFloat(x).toFixed(2);
}

function float_values_of_edit(data)
{
    data.unpaid_previous_account = financial(data.unpaid_previous_account);
    data.total_fees_for_sy = financial(data.total_fees_for_sy);
    data.tuition_fee = financial(data.tuition_fee);
    data.registration_fee = financial(data.registration_fee);
    data.others_books = financial(data.others_books);
    data.tuition_fee_as_of_value = financial(data.tuition_fee_as_of_value);
    data.registration_fee_as_of_value = financial(data.registration_fee_as_of_value);
    data.books_as_of_value = financial(data.books_as_of_value);
    data.outstanding_balance = financial(data.outstanding_balance);
    data.amount_payable_for_this_month_value = financial(data.amount_payable_for_this_month_value);
    return data;
}

function auto_compute_total_fee()
{
        let number = parseFloat(app.Edit.tuition_fee) + parseFloat(app.Edit.registration_fee) + parseFloat(app.Edit.others_books);
        app.Edit.total_fees_for_sy = number;
        app.bill_obj.total_fees_for_sy = numberWithCommas(financial(number));
        console.log(number);
}


function initiate_bill_obj()
{
    /* app.Edit.unpaid_previous_account = 0;
    app.Edit.total_fees_for_sy = 0;
    app.Edit.tuition_fee = 0;
    app.Edit.registration_fee = 0;
    app.Edit.others_books = 0;
    app.Edit.tuition_fee_as_of_value = 0;
    app.Edit.registration_fee_as_of_value = 0;
    app.Edit.books_as_of_value = 0;
    app.Edit.outstanding_balance = 0;
    app.Edit.amount_payable_for_this_month_value = 0; */
    app.Edit = new Object;
    /* app.bill_obj = new Object; */
    app.bill_obj = new Object;
    /* app.Edit.name = "name"
    app.Edit.unpaid_previous_account = financial(0);
    app.Edit.total_fees_for_sy = financial(0);
    app.Edit.tuition_fee = financial(0);
    app.Edit.registration_fee = financial(0);
    app.Edit.others_books = financial(0);
    app.Edit.tuition_fee_as_of_value = financial(0);
    app.Edit.registration_fee_as_of_value = financial(0);
    app.Edit.books_as_of_value = financial(0);
    app.Edit.outstanding_balance = financial(0);
    app.Edit.amount_payable_for_this_month_value = financial(0); */
    app.bill_obj.tuition_fee_as_of_month = month_now;
    app.bill_obj.registration_fee_as_of_month = month_now;
    app.bill_obj.books_as_of_month = month_now;
    app.bill_obj.amount_payable_for_this_month = month_now;
    app.bill_obj.remarks_month = month_now;

}

function refresh_preview_on_add()
{
    if (!app.EditStatus)
    {
        let temp;
        temp = app.bill_obj.name;
        app.bill_obj.name = "";
        app.bill_obj.name = temp;
    }

}


function save_records(data)
{
    $.ajax({
        type: "POST",
        url: "/records/save",
        data: data,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success:function(data){
            nData = JSON.parse(data);
            console.log(nData);
        },
    });
}
function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
}

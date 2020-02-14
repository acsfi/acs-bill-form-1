var date = new Date;
var month_now = date.toLocaleString('default', { month: 'long' });
var app = new Vue({
    el: '#app',
    data: {
    message: 'You loaded this page on ' + new Date().toLocaleString(),
    Edit: new Object,
    Add: false,
    List: true,
    Bills: Array,
    add_student_msg: "Add Student",
    create_student_msg: "",
    days: Days(),
    remarks_day_preview: String,
    grades: [
        { text: "None", value: null },
        { text: "Nursery", value: 0 },
        { text: "Kinder-1", value: 1 },
        { text: "Kinder-2", value: 2 },
        { text: "Grade-1", value: 3 },
        { text: "Grade-2", value: 4 },
        { text: "Grade-3", value: 5 },
        { text: "Grade-4", value: 6 },
        { text: "Grade-5", value: 7 },
        { text: "Grade-6", value: 8 },
    ],
    months: [
        { text: month_now, value: month_now },
        { text: "January", value: "January", selected: ""},
        { text: "February", value: "February", selected: ""},
        { text: "March", value: "March", selected: ""},
        { text: "April", value: "April", selected: ""},
        { text: "May", value: "May", selected: ""},
        { text: "June", value: "June", selected: ""},
        { text: "July", value: "July", selected: ""},
        { text: "August", value: "August", selected: ""},
        { text: "September", value: "September", selected: ""},
        { text: "October", value: "October", selected: ""},
        { text: "November", value: "November", selected: ""},
        { text: "December", value: "December", selected: ""},
        ],
    addprints: new Array,
    preview_print: false,
    preview_bill: false,
    bill_date: month_now+' '+date.getDate() +', '+date.getFullYear(),
    school_year: GetSchoolYear(),
    bill_obj: new Object,
    printables: new Array,
    complete_form_msg: "",
    Tip: false,
    Status: new Boolean,
    uuid: String,
    },
    methods: {
        GetBill: function () {
            let search_by_grade = $("#filter-grade-level").val();
            let search_name = $("#search-name").val();
            let data = {};
            if (search_by_grade >= 0)
            {
                data["filter_grade"] = search_by_grade;
            }
            if ( search_name && search_name.length > 0)
            {
                data["search_name"] = search_name;
                console.log(data);
            }
            $.ajax({
                type: "POST",
                url: "/bills",
                data: data,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                    let nData = JSON.parse(data);
                    if (nData.length < 1)
                    {
                        noRecordFound();
                        return;
                    }
                    app.Tip = false;
                    // console.log(nData);
                    app.Add = false;
                    app.List = true;
                    let newData = Check_Remarks_Day(nData);
                    app.Bills = newData;
                },
            });
        },
        AddStudent: function (id) {
            app.EditStatus = false;
            if (app.add_student_msg == "Cancel" || app.add_student_msg == "Cancel Edit")
            {
                app.Add = false;
                app.add_student_msg = "Add Student";
                app.List = true;
                app.Edit = new Object;
            }
            else
            {
                app.Add = true;
                app.add_student_msg = "Cancel";
                app.List = false;
                app.complete_form_msg = "Complete Form First."
            }

            app.create_student_msg = "Create Student";
            initiate_bill_obj();
            app.openPreviewBill();


        },
        CloseAddStudent: function () {
            app.Add = false;
            app.add_student_msg = "Add Student"
            app.List = true;
            app.Edit = new Object;
        },
        EditBill: function (id) {
            app.create_student_msg = "Update Student";
            app.complete_form_msg = "";
            app.EditStatus = true;
            $.ajax({
                type: "POST",
                url: "/get/bill/" + id,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                    nData = JSON.parse(data);
                    app.Edit = float_values_of_edit(nData);
                    app.add_student_msg = "Cancel Edit";
                    app.List = false;
                    app.Add = true;
                    app.PreviewBill(app.Edit.id);
                }
            });
        },
        AddToPrint: function (id) {
            $.ajax({
                type: "POST",
                url: "/get/bill/" + id,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                    nData = JSON.parse(data);
                    if(app.addprints.length == 4) app.clearAddToPrints();
                    app.addprints.push(nData);
                    app.PreviewPrint();
                },
            });
        },
        RemovePrint: function (index) {
            app.addprints.splice(index,1);
        },
        PreviewPrint: function () {
            app.preview_print = true;
            app.preview_bill = false;
        },
        PreviewBill: function (id) {
            $.ajax({
                type: "POST",
                url: "/get/bill/" + id,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                    nData = JSON.parse(data);
                    let new_Data = Check_Remarks_Day(nData);
                    app.bill_obj = new_Data;
                    app.openPreviewBill();
                    console.log(app.bill_obj);
                },
            });
        },
        Print: function () {
            let ids = [];
            app.addprints.forEach( (e) => {
                ids.push(e.id);
            });
            let str_ids = ids.join(",");
            $.ajax({
                type: "POST",
                url: "/print/bill/" + str_ids,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                    nData = JSON.parse(data);
                    if (nData.ids.length > 0)
                    {
                        window.open(nData.url, '_blank');
                    }
                },
            });
        },
        getPrintables: function () {
            $.ajax({
                type: "GET",
                url: "/printables",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                    nData = JSON.parse(data);
                    let new_Data = Check_Remarks_Day(nData.bills);
                    app.printables = new_Data;

                },
            });
        },
        clearAddToPrints: function () {
            app.addprints = new Array;
        },
        clearPreviewBill: function () {
            app.bill_obj = new Object;
        },
        openPreviewBill: function () {
            app.preview_bill = true;
            app.preview_print = false;
        },
        closePreviews: function () {
            app.preview_bill = false;
            app.clearPreviewBill();
            app.preview_print = false;
            app.clearAddToPrints();
        },
        Edit_upa: function () {
            app.bill_obj.unpaid_previous_account = numberWithCommas(financial(app.Edit.unpaid_previous_account));
            console.log(app.bill_obj.unpaid_previous_account);
            refresh_preview_on_add();
        },
        Edit_tffsy: function () {
            app.bill_obj.total_fees_for_sy = numberWithCommas(financial(app.Edit.total_fees_for_sy));
            refresh_preview_on_add();
        },
        Edit_tf: function () {
            console.log("wew");

            auto_compute_total_fee();
            app.bill_obj.tuition_fee = numberWithCommas(financial(app.Edit.tuition_fee));
            refresh_preview_on_add();
        },
        Edit_rf: function () {
            auto_compute_total_fee();

            app.bill_obj.registration_fee = numberWithCommas(financial(app.Edit.registration_fee));
            refresh_preview_on_add();
        },
        Edit_ob: function () {
            auto_compute_total_fee();

            app.bill_obj.others_books = numberWithCommas(financial(app.Edit.others_books));
            refresh_preview_on_add();
        },
        Edit_tfao: function () {
            app.bill_obj.tuition_fee_as_of_value = numberWithCommas(financial(app.Edit.tuition_fee_as_of_value));
            refresh_preview_on_add();
        },
        Edit_rfao: function () {
            app.bill_obj.registration_fee_as_of_value = numberWithCommas(financial(app.Edit.registration_fee_as_of_value));
            refresh_preview_on_add();
        },
        Edit_bao: function () {
            app.bill_obj.books_as_of_value = numberWithCommas(financial(app.Edit.books_as_of_value));
            refresh_preview_on_add();
        },
        Edit_outb: function () {
            app.bill_obj.outstanding_balance = numberWithCommas(financial(app.Edit.outstanding_balance));
            refresh_preview_on_add();
        },
        Edit_apftm: function () {
            app.bill_obj.amount_payable_for_this_month_value = numberWithCommas(financial(app.Edit.amount_payable_for_this_month_value));
            refresh_preview_on_add();
        },
        Edit_rd: function () {
            app.bill_obj.remarks_day = get_ordinal(app.Edit.remarks_day);
            refresh_preview_on_add();
        },
        SaveRecords: function () {
            console.log("nice");
        }
    },
    beforeMount(){
        this.GetBill();
        this.getPrintables();
        this.uuid = uuidv4();
    },
});



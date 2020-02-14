$(document).on("change", ".form-validate", function(){
    let inputs = $("input.form-validate").length;
    for (var i = 0; i < inputs; i++)
    {
        if ($("input.form-validate").eq(i).val() == "")
        {
            activate_btn_student_bill(0);
            return;
        }
    }
    activate_btn_student_bill(1);
    return;
});
$(document).on("change", "select", function(){
    refresh_preview_on_add();
});

$(document).on("click", "#create-student-bill-btn, #update-student-bill-btn",  function () {
    var id = $("#update-student-bill-btn").attr("data-id");
    var data = {};
    data["id"] = id;
    data["name"] = $("#name").val();
    data["unpaid_previous_account"] = $("#u-p-a").val();
    data["total_fees_for_sy"] = $("#t-f-f-s").val();
    data["tuition_fee"] = $("#t-f").val();
    data["registration_fee"] = $("#r-f").val();
    data["others_books"] = $("#o-b").val();
    data["tuition_fee_as_of_month"] = $("#tfao_month").val();
    data["tuition_fee_as_of_value"] = $("#tfao_value").val();
    data["registration_fee_as_of_month"] = $("#rfao_month").val();
    data["registration_fee_as_of_value"] = $("#rfao_value").val();
    data["books_as_of_month"] = $("#bao_month").val();
    data["books_as_of_value"] = $("#bao_value").val();
    data["outstanding_balance"] = $("#outstanding-balance").val();
    data["amount_payable_for_this_month"] = $("#apftmo_month").val();
    data["amount_payable_for_this_month_value"] = $("#apftmo_value").val();
    data["remarks_day"] = $("#remarks_day").val();
    data["remarks_month"] = $("#remarks_month").val();
    data["updated_at"] = timestamp();
    data["grade_level"] = $("#grade-level").val();
    if (id)
    {
        //update
        update_student_bill(data);
    }
    else
    {
        //add
        data["created_at"] = timestamp();
        create_student_bill(data);
    }


});


$(document).on("keyup", "#search-name", function () {
    app.GetBill();
});


$(document).on("keydown",".number-only",function(e) {
    if (!isNumberKey(e)) e.preventDefault();
});


$(document).on("keyup","#remarks_day",function(e) {
    let value = $(this).val();
    app.bill_obj.remarks_day = get_ordinal(value);
});


window.addEventListener("afterprint", function(event) {
    var data = {};
    data["ids"] = [];
    app.printables.forEach((e)=>{
        data["ids"].push(e.id);
    });
    data["uuid"] = app.uuid;
    console.log(data);
    save_records(data);
});

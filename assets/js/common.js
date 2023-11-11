function get_money_exchange_form( buySell ) {


    if( buySell === 'Buy Dollar' ){
        var need_bkashTrId = '<label for="bKash_tRX_ID">bKash Transaction ID:</label>\
            <input type="text" id="bKash_tRX_ID" name="bKash_tRX_ID" required><br>';
        // $("#transactionType").val('buy');
        var type = 'buy';
    }else{
        need_bkashTrId = '';
        type ='sell';
    }
    $("#buySellCardHolder").fadeIn();
    let buySellForm = '<div class="form-container">\
                        <form id="transaction-form">\
                            <label for="send_method">Send Method:</label>\
                            <select id="send_method" name="send_method" required>\
                                <option value="">Select Send Method</option>\
                                <option value="method1">Bkash</option>\
                            </select><br>\
                            <label for="receive_method">Receive Method:</label>\
                            <select id="receive_method" name="receive_method" required>\
                                <option value="">Select Receive Method</option>\
                                <option value="skrill">Skrill</option>\
                                <option value="neteller">Neteller</option>\
                                <option value="perfectMoney">Perfect Money</option>\
                            </select><br>\
                            <label for="send_amount">Send Amount:</label>\
                            <input type="number" id="send_amount" name="send_amount" required><br>\
                            <label for="receive_amount">Receive Amount:</label>\
                            <input type="number" id="receive_amount" name="receive_amount" readonly required><br>\
                            <label for="bKash_number">bKash Number:</label>\
                            <input type="text" id="bKash_number" name="bKash_number" required><br>\
                            '+need_bkashTrId+'\
                            <label for="skrill_email">Skrill Email:</label>\
                            <input type="email" id="skrill_email" name="skrill_email" required><br>\
                            <label for="contact_no">Contact Number:</label>\
                            <input type="tel" id="contact_no" name="contact_no" required><br>\
                            <input type="text" id="transactionType" name="transactionType" value="'+type+'" style="display: none"><br>\
                            <div class="submitCancelBtnHolder"><div class="submitBuySell" id="submitBuySell">Submit</div><div class="cancelBuySell" id="cancelBuySell">Cancel</div></div>\
                        </form>\
                        <div id="response"></div>\
                    </div>';

    return buySellForm;
}

function navigate_tabs( clickClassHolderIdName, clickClassName, addSelectedClass, display_type, display_limit ){
    $("#"+clickClassHolderIdName).on("click","."+clickClassName+"",function() {
        let adminNavId = $(this).attr('id');
        let adminNavHolderId = adminNavId+'_holder';
        //Navigate tab and tab content
        $("#"+adminNavId).addClass(addSelectedClass);
        $("#"+adminNavId).siblings().removeClass(addSelectedClass);
        $("#"+adminNavHolderId).show();
        $("#"+adminNavHolderId).siblings().hide();
        //End
        /*let loadedIds ="";
        let end_point = "../main/jsvalidation/postsLoadForManage.php";
        let body_data = {
            action: adminNavId,
            limit: display_limit,
            loadedIds : loadedIds
        };
        // get_data_from_api( end_point, body_data, adminNavHolderId, display_type );
*/
    });
}

function buy_sale_card_for_manage(){
   let aaa = '<div class="card">\
        <h2>User Information</h2>\
    <p><strong>bKash Number:</strong> 34534534</p>\
    <p><strong>bKash Transaction ID:</strong> 3534534</p>\
    <p><strong>Contact Number:</strong> 433543</p>\
    <p><strong>Create Time:</strong> 2023-11-07 22:15:45</p>\
    <p><strong>Full Name:</strong> MD Rubel</p>\
    <p><strong>Transaction Status:</strong> Not Completed</p>\
    <p><strong>Email:</strong> cuet10@gmail.com</p>\
    <p><strong>Received Amount:</strong> 345345</p>\
    <p><strong>Received Method:</strong> method1</p>\
    <p><strong>Sent Amount:</strong> 34534543</p>\
    <p><strong>Sent Method:</strong> method1</p>\
    <p><strong>Skrill Email:</strong> fdsfsdfs@gmail.com</p>\
    <p><strong>Transaction Date:</strong> 2023-11-07 23:30:36</p>\
    <p><strong>Transaction Key:</strong> 0461ebd2b7t</p>\
    <p><strong>Transaction Type:</strong> Buy</p>\
    <p><strong>User Key:</strong> 3e7b30dd</p>\
    <hr>\
    </div>'

    return aaa;
}

function get_data_from_api( end_point, body_data, appendedId, display_type ){
    if( end_point ) {
        $.post(
            end_point,
            body_data,
            function (data) {
                // try {
                    let result_data = JSON.parse(data);
                    if (result_data['success']) {
                        let finalData = result_data.data;
                        alert(result_data.message);
                        // let card = buy_sale_card_for_manage();
                        // $("#butDollar_holder").append( card );
                    } else {
                        console.log(result_data['error_code']);
                        console.log(result_data['data']);
                    }
                /*} catch (error) {
                    console.log(error);
                }*/
            });
    }else{
        alert("Please Provide Valid Api End Point");
    }
}

function registrationSubmitForm( validateUrl ) {
    var formData = new FormData($("#registrationForm")[0]);

    $.ajax({
        url: validateUrl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}




$(document).ready(function () {
    $("#profileFormextraData").submit(function (event) {
        event.preventDefault();
        var valid = false;
        let phone = $("#phone").val();
        let about = $("#about").val();
        if( phone !== '' || about !=='' ){
            valid = true;
        }
        if ( !valid && 1 ===2 ) {
            event.preventDefault(); // Prevent form submission if validation fails
            $(".error-message").html("Please fix the errors in the form.");
        } else {
            let formData = new FormData(this);
            // Backend validation and processing using AJAX
            $.ajax({
                type: "POST",
                url: "main/jsvalidation/extraprofiledata.php",
                data: formData, // Use FormData for handling file uploads
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    let responseData = JSON.parse(response);
                    if( responseData['success']){
                        location.reload();
                    }else{
                        location.reload();
                    }
                    // You can redirect or display a success message here
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });

            event.preventDefault(); // Prevent the default form submission
        }
    });
});

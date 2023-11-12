$(document).ready(function () {
    $("#registrationForm").submit(function (event) {
        // Frontend validation
        var valid = true;
        // var formData = $(this).serializeArray();
        // Check if passwords match
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        if (password !== confirmPassword) {
            $("#confirmPassword").addClass("error");
            valid = false;
        } else {
            $("#confirmPassword").removeClass("error");
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
            $(".error-message").html("Please fix the errors in the form.");
        } else {
            let formData = new FormData(this);
            // Backend validation and processing using AJAX
            $.ajax({
                type: "POST",
                url: "main/jsvalidation/registration.php",
                data: formData, // Use FormData for handling file uploads
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    let responseData = JSON.parse(response);
                    // Handle the response from the server
                    console.log(responseData);
                    if( responseData['success']){
                        showPopUpMessage( responseData['message'], needTitle=false , neededConfirmButton= false, confirmButtonId=false, confirmButtonClass=false );
                        setTimeout( hidePopUpMessage, 2000);
                        window.location.href = "login.php";
                    }else{
                        showPopUpMessage( responseData['message'], needTitle=false , neededConfirmButton= false, confirmButtonId=false, confirmButtonClass=false );
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

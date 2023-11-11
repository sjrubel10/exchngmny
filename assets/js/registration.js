
$(document).ready(function() {

    function isValidEmail(email) {
        // Simple email format validation using a regular expression
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(email);
    }

    function isValidUsername(username) {
        // Username validation (letters and numbers only)
        return /^[a-zA-Z0-9]+$/.test(username);
    }

    $("#registrationForm").submit(function(event) {
        event.preventDefault();
        let isValid = true;
        $(".error-message").text("");

        // Validation for email format
        let email = $("#email").val();
        if (!isValidEmail(email)) {
            $("#emailError").text("Invalid email format.");
            isValid = false;
        }

        // Validation for username (letters and numbers only)
        let username = $("#username").val();
        if (!isValidUsername(username)) {
            $("#usernameError").text("Username can only contain letters and numbers.");
            isValid = false;
        }
        let password = $("#password").val();
        let confirmPassword = $("#confirmPassword").val();
        if ( password !== confirmPassword ) {
            $("#confirmPasswordError").text("Password Is Not Matched.");
            isValid = false;
        }

        // Other form field validations (password, first name, last name, age, etc.)

        if (isValid) {
            // Submit the form via AJAX to the PHP script for backend validation
            /*$.post("main/jsvalidation/registration.php", $("#registrationForm").serialize(), function(data) {
                $("#message").html(data);
            });*/
            // let formData = $("#registrationForm").serialize();
            var formData = new FormData($("#registrationForm")[0]);
            console.log( formData );
            $.ajax({
                type: "POST",
                url: 'main/jsvalidation/registration.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var result= JSON.parse(response);
                    console.log( result ); // Show response from PHP (success or error message)
                    if(result['success']){
                        window.location.href = "../index.php";
                    }
                    // You can redirect to another page or clear the form if needed
                }
            });
        }
    });
});


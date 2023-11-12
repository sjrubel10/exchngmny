$(document).ready(function() {
    $("#loginForm").submit(function(event) {
        event.preventDefault();
        let useremail = $("#email").val();
        let password = $("#password").val();
        $.post("main/jsvalidation/login.php",
            {
                useremail: useremail,
                password: password
            },
            function(data) {
                // json_decode
                let result_data = JSON.parse( data );
                console.log( result_data );
                if ( result_data['success'] ) {
                    $("#message").text(result_data['message']);

                    window.location.href = "profile.php?profilekey="+result_data['profilekey'];
                } else {
                    $("#usernameError").text(result_data['message']);
                }
            });
        });
});

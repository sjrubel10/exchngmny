<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 10/15/2023
 * Time: 11:27 PM
 */
require "../../main/init.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email format
    $result = 0;
    if( isset( $_POST ) && !empty( $_POST ) ){
        $useremail = sanitize($_POST['useremail']);
        $enteredPassword = sanitize($_POST['password']);
        $userId = getUserIdByuseremail( $useremail );

        if( $userId ){
            $user_data = getUserDataById( $userId );
            $valid_email = $user_data['mail'];
            $valid_password = $user_data['password'];
            if ( $useremail === $valid_email && password_verify( $enteredPassword, $valid_password ) ) {
                $_SESSION['logged_in'] = true;
                $_SESSION['logged_in_user_data'] = $user_data;
                $result = array(
                    'success'=> true,
                    'message'=>'Login successful',
                    'status_code'=> 200,
                    'profilekey'=> $user_data['userkey'],
                );
            } else {
                $_SESSION['logged_in'] = false;
                unset($_SESSION['logged_in_user_data']);
                $result = array(
                    'success'=> false,
                    'message'=>"Login failed. Check your username and password.",
                    'status_code'=> 400
                );
            }

        }else{
            $result = array(
                'success'=> false,
                'message'=>"User Not Exist.",
                'status_code'=> 400
            );
        }

    }else{
        $result = array(
            'success'=> false,
            'message'=>"Invalid request.",
            'status_code'=> 400
        );
    }

    echo json_encode( $result );
}


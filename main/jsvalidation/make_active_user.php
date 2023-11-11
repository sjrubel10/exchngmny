<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 10/30/2023
 * Time: 10:57 PM
 */
require "../../main/init.php";
if( isset( $_SESSION['logged_in'] ) && $_SESSION['logged_in'] ){
    if( $_SESSION['logged_in_user_data']['admin']=== 1 ) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate email format
            $result = 0;
            if (isset($_POST) && !empty($_POST)) {
                $activate = (int)sanitize($_POST['active']);
                $userkey = sanitize($_POST['userkey']);
                $deleteOrAdd = sanitize($_POST['deleteOrAdd']);
                $user_id = getUserIdByProfileKey( $userkey );
                if ( is_numeric( $user_id ) ) {
                    $update =updateUserToActivated( $user_id, $activate );
                    if ( $update ) {
                        $message = 'Successfully Activate This user';

                        /*$fromSentMail ="example@gmail.com";
                        $userEmail ="rubelcuet10@gmail.com";
                        sendActivationEmail( $userEmail, $fromSentMail );*/
                        $result = array(
                            'success' => true,
                            'message' => $message,
                            'status_code' => 200
                        );
                    } else {
                        $result = array(
                            'success' => false,
                            'message' => "Error in the prepared statement or Database Connection",
                            'status_code' => 400
                        );
                    }

                } else {
                    $result = array(
                        'success' => false,
                        'message' => "User is not Exist.",
                        'status_code' => 400
                    );
                }

            } else {
                $result = array(
                    'success' => false,
                    'message' => "Invalid request.",
                    'status_code' => 400
                );
            }

            echo json_encode($result);
        }
    }else{
        $result = array(
            'success'=> false,
            'message'=>"You are not eligible to access this page",
            'status_code'=> 400
        );
    }
}else{
    $result = array(
        'success'=> false,
        'message'=>"You are not eligible to access this page",
        'status_code'=> 400
    );
}



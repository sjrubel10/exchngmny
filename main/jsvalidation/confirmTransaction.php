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
            $adminID =  $_SESSION['logged_in_user_data']['id'];
            if (isset($_POST) && !empty($_POST)) {
                $buySellKey = sanitize($_POST['buySellKey']);
                $transactionId = getIDBytransactionKey( $buySellKey );
                if ( is_numeric( $transactionId ) && $transactionId> 0 ) {
                    $update =transaction_confirmation( $transactionId, $adminID );
                    if ( $update ) {
                        $message = 'Transaction Successfully Completed';
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



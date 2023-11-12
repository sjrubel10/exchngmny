<?php
require_once "database/connect.php";
require_once "functions/allfunctions.php";
require_once "constants.php";
session_start();
//var_test_die( $_SESSION );

$fromSentMail = 'example@gmail.com';

if( isset( $_SESSION['logged_in']) && $_SESSION['logged_in'] === true ){
    if(  isset( $_SESSION['logged_in_user_data'] ) && $_SESSION['logged_in_user_data']['admin'] ===1 && $_SESSION['logged_in_user_data']['active'] === 1 && $_SESSION['logged_in_user_data']['recorded'] ===1 ){
        $is_admin = true;
    }else{
        $is_admin = false;
    }
    $is_logged_in = true;
}else{
    $is_logged_in = false;
    $is_admin = false;
}


<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 10/9/2023
 * Time: 10:09 PM
 */
require "main/init.php";
$filename = 'managesite/siteInfo.json';
$siteInfoData = getDataFromJsonFile( $filename );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/headerfooter.css">
    <link rel="stylesheet" type="text/css" href="assets/css/registration_login.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/popupmessage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/registration.js"></script>
    <script src="assets/js/popupmessage.js"></script>
    <title>Registration</title>
</head>
<body>

<?php
include_once "views/header.php";
include_once "views/registrationForm.php";
include "views/footer.php";
?>


<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 10/9/2023
 * Time: 10:10 PM
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/login.js"></script>
    <title>Login</title>
</head>
<body>
<?php
//include "views/header.php"; ?>
<?php include_once "views/header.php"?>
<div class="loginContainerHolder">
    <div class="logincontainer">
        <h2>Login</h2>
        <form id="loginForm" method="post">
            <div class="login_form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="login_form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button class="loginSubmit" type="submit">Login</button>
        </form>
        <div class="loginMessageShown">
            <span id="message" class="error-message"></span>
            <span id="usernameError" class="success-message"></span>
        </div>

        <div class="createNewAccount"><a href="/<?php echo HOSTNAME?>registration.php">Create A New Account</a></div>
    </div>
</div>

<?php
    include "views/footer.php";
?>


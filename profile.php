<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 11/12/2023
 * Time: 5:29 PM
 */
require "main/init.php";

//var_test_die( $_SESSION['logged_in_user_data']['admin'] );
if( isset( $_GET['profilekey'] ) ){
    $profilekey = sanitize( $_GET['profilekey'] );
    $keylength = strlen( $profilekey );
    $is_accesible = false;
    $userData = [];
    if( $keylength === 8 && containsOnlyLettersAndNumbers( $profilekey ) ){
        $userData = getUserDataByprofileKey( $profilekey );
        if( count( $userData ) === 0){
            header("Location: index.php");
        }
        if( $is_logged_in ){
            if( $_SESSION['logged_in_user_data']['id'] === $userData['id'] || $_SESSION['logged_in_user_data']['admin'] === 1 ){
                $is_accesible = true;
            }else{
                header("Location: index.php");
            }
        }else {
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }

    $filename = 'managesite/siteInfo.json';
    $siteInfoData = getDataFromJsonFile( $filename );
    if( $is_accesible ){ ?>
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
        <link rel="stylesheet" href="assets/css/profile.css">
        <script src="assets/js/extraprofiledata.js"></script>

        <title>User Profile</title>
    </head>
    <body>

    <?php
        include_once "views/header.php";
        if( $userData['active'] === 0 && $userData['is_profile_info_provided'] === 0 ){?>
    <div class="profile-container_holder">
        <div class="profile-container">
            <div class="form-container">
                    <p class="notifyActivateMessage">Your Account is Created and not activated At
                        this moment so You can not make any transaction. To ensure an
                        y transaction please provide the following information and submit the button.
                        Our Admin will check and Activate your account and you will be notify on email. Thank you!!
                    </p>
                    <h2>Insert Profile Data</h2>
                    <form id="profileFormextraData" method="POST" enctype="multipart/form-data">
                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="phone" required>

                        <label for="about">About Yourselves:</label>
                        <textarea id="about" name="about" rows="4" required></textarea>

                        <label for="image1">Image NID Front Side:</label>
                        <input type="file" id="nidFrontSide" name="nidFrontSide" accept="image/*" required>

                        <label for="image2">Image NID Back Side:</label>
                        <input type="file" id="nidBackSide" name="nidBackSide" accept="image/*" required>

                        <input type="submit" value="Insert">
                    </form>
                </div>
        </div>
        <?php }
        if( $userData['active'] === 0 && $userData['is_profile_info_provided'] === 1){?>
        <div class="profile-container">
            <div class="waitingForVerify">
                    <span class="waitingForVerifytext">
                        Your account has already been created. </br> Profile verification is currently in progress. Please wait for the confirmation email.
                    </span>
                </div>
        </div>
        <?php } ?>
        <div class="profile-container">
            <div class="profile-header">
                <img class="imageProfile" src="assets/images/profileimages/<?php echo $userData['profileimage']?>" alt="<?php echo $userData['full_name']?>">
                <h1><?php echo $userData['full_name']?></h1>
                <p><?php echo $userData['mail']?></p>
                <p><?php echo $userData['mobile']?></p>
            </div>
            <div class="profile-body">
                <h2>About Me</h2>
                <p><?php echo $userData['about']?></p>
            </div>
        </div>
       <?php if( $userData['is_profile_info_provided'] === 1 ){?>
            <div class="profile-container">
                <h2 class="userMid">Your Nid</h2>
                <div class="userNidHolder">
                    <div class="userNidfrontside" id="userNidfrontside">
                        <span class="userNidfrontsideText">Front Side Nid</span>
                        <img class="userNidfrontsideImg" alt="Front Side Nid" src="assets/images/usernid/<?php echo $userData['usernidfrontside']?>">

                    </div>
                    <div class="userNidfrontside" id="userNidfrontside">
                        <span class="userNidfrontsideText">back Side Nid</span>
                        <img class="userNidfrontsideImg" alt="back Side Nid" src="assets/images/usernid/<?php echo $userData['usernidbackside']?>">
                    </div>
                </div>
            </div>
        <?php }
        if( $userData['is_profile_info_provided'] === 1 && $userData['active'] === 1 ){ ?>
            <div class="profile-container">
                <h2 class="userMid">Your Transaction</h2>
                <div class="userTransactionHolder">
                    <div class="">You have No Transaction</div>
                </div>
            </div>
        <?php } ?>
    </div>
    </body>
    </html>
<?php }  else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}

?>

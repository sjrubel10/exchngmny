<?php
    require "../main/init.php";
    $conn = Db_connect();
    $display_limit = 20;
    $already_loaded_ids = [];
    $usersData = getUsersData( $conn, $already_loaded_ids, $display_limit );

    $buy_data =  selectBuySellData( $user_id = '' , $transaction_type='buy' );
    $sell_data =  selectBuySellData( $user_id = '' , $transaction_type='sell' );
    $all_data =  selectBuySellData( $user_id = '' , $transaction_type='' );
//    var_test_die( $buy_data );

$forDollerBuy = [ "No","User Name", "userEmail", "Contact Number", "Bkash Number", "bKash Transaction ID", "Send Amount", "Received Amount",
    "Received Method", "Send Method",  "Transaction Date", "Action"
];

$filename = 'siteInfo.json';
$siteInfoData = getDataFromJsonFile( $filename );

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="adminassets/css/admin.css">
        <link rel="stylesheet" href="adminassets/css/siteinfo.css">
        <link rel="stylesheet" href="../assets/css/header.css">
        <link rel="stylesheet" href="../assets/css/common.css">
        <script src="../assets/js/common.js"></script>
    </head>
    <body>
         <?php if( isset( $_SESSION['logged_in'] ) && isset( $_SESSION['logged_in_user_data'] ) && $_SESSION['logged_in'] === true && $_SESSION['logged_in_user_data']['admin'] ===1 && $_SESSION['logged_in_user_data']['recorded'] ===1 ){?>
             <?php include_once "../views/header.php"?>
             <div class="container" id="adminContainer">
                <div class="sidebar">
                    <h1>Admin Panel</h1>
                    <ul>
                        <li class="manage-admins adminTabChange" id="manage-users">Manage Users</li>
                        <li class="manage-posts adminTabChange" id="manage-buy_sell">Manage Buy Sell</li>
                        <li class="updateSiteInfo adminTabChange" id="updateSiteInfo">Update Site Info</li>
                    </ul>
                </div>
                <div class="admincontentholder">
                    <div id="manage-users_holder" class="tab-content" style="display: block">
                        <h2>Manage Users</h2>
                        <div class="adminDisplayUserInfoHolder">
                            <?php include "views/admindisplayuserinfo.php"?>
                        </div>

                    </div>
                    <div id="manage-buy_sell_holder" class="tab-content">
                        <?php require "views/manage_posts_admin.php"?>
                    </div>
                    <div id="updateSiteInfo_holder" class="tab-content">
                        <?php require "views/update_site_info.php"?>
                    </div>
                </div>
            </div>
        <?php } else{
             header('Location:index.php');
         }?>
    </body>
    <script src="adminassets/js/admin.js"></script>

</html>

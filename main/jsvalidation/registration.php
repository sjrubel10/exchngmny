<?php
require "../../main/init.php";

// Validate and insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email format

    if( isset( $_POST ) && !empty( $_POST ) ){

//        var_test_die( $_FILES );
        $timestamp = time(); // Get current timestamp
//        $imageFileName = $timestamp . '_' . basename( $_FILES["profileImage"]["name"] ); // Append timestamp to the image file name
        $imageFileName  = substr( md5( basename( $_FILES["profileImage"]["name"] ) ), 0, 43); // Append timestamp to the image file name

        $imageFileName .= '.jpeg';
        $targetDir = "../../assets/uploads/profileimages/";
        $targetFile = $targetDir . $imageFileName;
        $result = user_registration( $_POST, $imageFileName );

        move_uploaded_file( $_FILES["profileImage"]["tmp_name"], $targetFile );
    }else{
        $result = 0;
    }

    echo json_encode( $result );
}
?>

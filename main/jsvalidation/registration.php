<?php
require "../../main/init.php";
// Validate and insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email format
    if( isset( $_POST ) && !empty( $_POST ) ){
        $timestamp = time(); // Get current timestamp
        $imageFileName  = substr( md5( basename( $_FILES["profileImage"]["name"] ) ), 0, 43); // Append timestamp to the image file name
        $imageFileName .= returnImageType( $_FILES["profileImage"]["type"] );
        $targetDir = "../../assets/images/profileimages/";
        $targetFile = $targetDir . $imageFileName;
        $result = user_registration( $_POST, $imageFileName );
        move_uploaded_file( $_FILES["profileImage"]["tmp_name"], $targetFile );
    }else{
        $result = array(
            'success' => false,
            'message'=>'Invalid request',
            'status_code'=>303
        );
    }
}else{
    $result = array(
        'success' => false,
        'message'=>'Invalid request',
        'status_code'=>303
    );
}

echo json_encode( $result );
?>

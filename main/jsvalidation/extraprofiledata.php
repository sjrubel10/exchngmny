<?php
require "../../main/init.php";
// Validate and insert data into the database
if( $is_logged_in ) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST) && !empty($_POST)) {
            $timestamp = time(); // Get current timestamp
            $nidFrontSide = substr(md5(basename($_FILES["nidFrontSide"]["name"] . $timestamp)), 0, 43); // Append timestamp to the image file name
            $nidFrontSide .= returnImageType($_FILES["nidFrontSide"]["type"]);

            $nidBackSide = substr(md5(basename($_FILES["nidBackSide"]["name"] . $timestamp)), 0, 43); // Append timestamp to the image file name
            $nidBackSide .= returnImageType($_FILES["nidBackSide"]["type"]);
            $targetDir = "../../assets/images/usernid/";
            $nidFrontSideFile = $targetDir . $nidFrontSide;
            $nidBackSideFile = $targetDir . $nidBackSide;
            $userId = $_SESSION['logged_in_user_data']['id'];
            $mobile = sanitize( $_POST['phone'] );
            $about = sanitize( $_POST['about'] );
            $result = updateUserExtraData( $userId, $mobile, $about, $nidFrontSide, $nidBackSide );
            if($result){
                move_uploaded_file($_FILES["nidFrontSide"]["tmp_name"], $nidFrontSideFile);
                move_uploaded_file($_FILES["nidBackSide"]["tmp_name"], $nidBackSideFile);
                $result = array(
                    'success' => true,
                    'message' => 'Successfully Update',
                    'status_code' => 202
                );
            }else{
                $result = array(
                    'success' => false,
                    'message' => 'Database Error!',
                    'status_code' => 202
                );
            }
        } else {
            $result = array(
                'success' => false,
                'message' => 'Invalid request',
                'status_code' => 303
            );
        }
    } else {
        $result = array(
            'success' => false,
            'message' => 'Invalid request',
            'status_code' => 303
        );
    }
}else{
    $result = array(
        'success' => false,
        'message' => 'Please Logged In First',
        'status_code' => 505
    );
}

echo json_encode( $result );
?>

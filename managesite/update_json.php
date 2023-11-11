<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 11/10/2023
 * Time: 12:19 AM
 */
require  "../main/init.php";
if( isset( $_SESSION['logged_in'] ) && $_SESSION['logged_in'] ) {
    if ($_SESSION['logged_in_user_data']['admin'] === 1) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $formData = $_POST;
            // Read existing JSON data from file
            $filename = 'siteInfo.json';
            $jsonData = json_decode(file_get_contents($filename), true);
            // Update JSON data with form input
            foreach ($formData as $key => $value) {
                if (isset($jsonData[$key])) {
                    $jsonData[$key] = $value;
                }
            }
            // Write updated JSON data back to the file
            file_put_contents($filename, json_encode($jsonData, JSON_PRETTY_PRINT));

            // Redirect to the form page (you can change this to another page)
            header("Location: admin.php");
            exit();
        }
    }
}

?>


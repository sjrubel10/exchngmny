<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 11/9/2023
 * Time: 11:57 PM
 */
function getDataFromJsonFile( $filename ) {
    // Read the contents of the JSON file
    $jsonString = file_get_contents($filename);
    // Decode the JSON string into a PHP associative array
    $data = json_decode($jsonString, true);
    // Check if decoding was successful
    if ($data === null) {
        // Handle the error, maybe log or throw an exception
        throw new Exception("Error decoding JSON file");
    }
    return $data;
}

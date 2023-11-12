<?php
function insertBuyData( $insert_data, $user_id ){
    $conn = Db_connect();
    $sendMethod = isset($insert_data['send_method']) ? sanitize( $insert_data['send_method'] ) : "" ;
    $receiveMethod = isset($insert_data['receive_method']) ? sanitize( $insert_data['receive_method'] ) : "";
    $sendAmount = isset( $insert_data['send_amount'] ) ? sanitize( $insert_data['send_amount'] ) : 0;
    $receiveAmount = isset($insert_data['receive_amount']) ? sanitize( $insert_data['receive_amount'] ) : 0;
    $bKashNumber = isset($insert_data['bKash_number']) ? sanitize( $insert_data['bKash_number'] ) : 0;
    $bKashTransactionID = isset($insert_data['bKash_tRX_ID']) ? sanitize( $insert_data['bKash_tRX_ID'] ) : 0;
    $skrillEmail = isset($insert_data['skrill_email']) ? sanitize( $insert_data['skrill_email'] ) : "";
    $contactNumber = isset( $insert_data['contact_no']) ? sanitize( $insert_data['contact_no'] ) : 0;
    $transaction_type = isset( $insert_data['transactionType']) ? sanitize( $insert_data['transactionType'] ) : NULL;
    $userID = $user_id;
    $transaction_key = substr(md5($bKashTransactionID.$transaction_type), 0, 11);
    $recorded = 1;

// Prepare the SQL statement
    $sql = $conn->prepare("INSERT INTO `buysell` ( `transaction_key` ,`send_method`, `receive_method`, `send_amount`, `receive_amount`, `bKash_number`, `bKash_tRX_ID`, `skrill_email`, `contact_no`, `user_id`, `recorded`, `transaction_type` ) 
                       VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
// Bind parameters
    $sql->bind_param("sssiiiisiiis", $transaction_key, $sendMethod, $receiveMethod, $sendAmount, $receiveAmount, $bKashNumber, $bKashTransactionID, $skrillEmail, $contactNumber, $userID, $recorded, $transaction_type );
// Execute the statement
    if ($sql->execute()) {
        $result = array(
            'success' => true,
            'message'=>"Thank You! </br> Your Transaction Successfully Completed",
            'status_code'=>202
        );
    } else {
        $result = array(
            'success' => false,
            'message'=>"Error: " . $sql->error,
            'status_code'=>303
        );
    }
// Close the statement and connection
    $sql->close();
    $conn->close();
    return $result;
}

function getIDBytransactionKey( $transaction_key ) {
    $conn = Db_connect();
    $sql = "SELECT ID FROM `buysell` WHERE transaction_key = ?";
    $stmt = $conn->prepare($sql);
    if( $stmt ) {
        $stmt->bind_param("s", $transaction_key);
        $stmt->execute();
        $stmt->bind_result($transactionId);
        $stmt->fetch();
        $stmt->close();

        $conn->close();
    }else{
        $transactionId = false;
    }

    return $transactionId;
}

function selectBuySellData( $user_id= '' , $transaction_type='', $already_loaded_ids=[] ) {
    $conn = Db_connect();

    if( count( $already_loaded_ids )> 0 ){
        $already_loaded_ids_str = implode( ",",$already_loaded_ids);
        $not_Id = " `id` NOT IN($already_loaded_ids_str) ";
        $is_loaded = true;
    }else{
        $not_Id = "";
        $is_loaded = false;
    }

    $bindPrm = true;
    $and = true;
    $is_multiple = 0;
    if( $user_id ==='' &&  $transaction_type === '' ){
        $condition = ' WHERE `is_transaction_done` = 1';
        $prepare = '';
        $value = "";
        $bindPrm =false;
        $and = false;
    }else if( $user_id !=='' &&  $transaction_type === '' ){
        $condition = "WHERE `user_id` = ? AND `is_transaction_done`=1 ";
        $prepare = 'i';
        $value = "$user_id";
    }else if( $user_id ==='' &&  $transaction_type !== '' ){
        $condition = " WHERE `transaction_type` = ? AND `is_transaction_done`=0";
        $prepare = 's';
        $value = "$transaction_type";
    }else{
        $condition = "WHERE `user_id`=? AND `transaction_type` = ? AND `is_transaction_done`=0";
        $prepare = "is";
        $is_multiple = 1;
        $value = "$user_id, $transaction_type";
    }

    if( $is_loaded === true && $and === true ){
        $and = "AND";
    }else{
        $and = "";
    }
    // Define the query with a prepared statement
    $query = "SELECT * FROM `buysell` INNER JOIN users ON `buysell`.`user_id` = `users`.`id` $condition $and $not_Id LIMIT 150";
    $stmt = $conn->prepare($query);
    if( $bindPrm ){
        if( $is_multiple === 1 ){
            $stmt->bind_param( $prepare, $user_id, $transaction_type );
        }else{
            $stmt->bind_param( $prepare, $value );
        }

    }
    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch the rows into an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        unset($row['ID']);
        unset($row['admin']);
        unset($row['admin_id']);
        unset($row['password']);
        unset($row['user_id']);
        unset($row['id']);
        unset($row['username']);
        unset($row['active']);
        $data[$row['transaction_key']] = $row;

    }
    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    return $data;
}

function transaction_confirmation( $transactionId, $adminId ){
        $conn = Db_connect();
        $result = false;
        $sql = " UPDATE `buysell` SET `is_transaction_done` = 1, `admin_id` = ? WHERE `ID` = ?";
        // Create a prepared statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error in the prepared statement: " . $conn->error);
        }
        // Bind the parameter
        $stmt->bind_param("ii", $adminId, $transactionId ); // "i" represents an integer
        // Execute the statement
        $result = $stmt->execute();
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        return $result;
}

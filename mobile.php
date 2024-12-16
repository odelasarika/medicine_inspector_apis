<?php
include 'connection.php';
date_default_timezone_set('Asia/Kolkata');

// Check if mobile number is provided
if (isset($_POST['mobile_number'])) {
    $mobile_number = $con->real_escape_string($_POST["mobile_number"]);

    // Generate a random OTP (4-digit)
    $otp = rand(1000, 9999);

    // Check if the mobile number already exists in the database
    $select_sql = "SELECT * FROM user_login WHERE mobile_number = '$mobile_number'";
    $result = $con->query($select_sql);

    if ($result->num_rows > 0) {
        // Mobile number exists; update the OTP
        $update_sql = "UPDATE user_login SET otp = '$otp' WHERE mobile_number = '$mobile_number'";
        
        if ($con->query($update_sql) === TRUE) {
            echo json_encode(array("status" => "true", "otp" => $otp, "message" => "OTP updated successfully"));
        } else {
            echo json_encode(array("status" => "false", "message" => "Error updating OTP: " . $con->error));
        }
    } else {
        // Mobile number does not exist; insert a new record
        //if (isset($_POST['user_name']) && isset($_POST['status'])) {
          //  $user_name = $con->real_escape_string($_POST["user_name"]);
            //$status = $con->real_escape_string($_POST["status"]);

            $insert_sql = "INSERT INTO user_login ( mobile_number) 
                VALUES ( '$mobile_number' )";

            if ($con->query($insert_sql) === TRUE) {
                echo json_encode(array("status" => "true", "otp" => $otp, "message" => "Data inserted successfully with new OTP"));
            } else {
                echo json_encode(array("status" => "false", "message" => "Error inserting data: " . $con->error));
            }
        }
    //     } else {
    //         echo json_encode(array("status" => "false", "message" => "Missing required fields for insertion"));
        
    // }
}
else {
    echo json_encode(array("status" => "false", "message" => "No mobile number provided"));
}

$con->close();
?>

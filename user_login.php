<?php
include 'connection.php';
date_default_timezone_set('Asia/Kolkata');

// Check if email (user_name) and password are provided
if (isset($_POST['user_name']) && isset($_POST['password'])) {
    $user_name = $con->real_escape_string($_POST['user_name']); // Corrected variable name
    $password = $con->real_escape_string($_POST['password']);

    // Check if the user_name already exists in the database
    $select_sql = "SELECT * FROM user_login WHERE user_name = '$user_name'";
    $result = $con->query($select_sql);

    if ($result->num_rows > 0) {
        // user_name exists; update the password
        $update_sql = "UPDATE user_login SET password = '$password' WHERE user_name = '$user_name'";
        if ($con->query($update_sql) === TRUE) {
            echo json_encode(array("status" => "true", "message" => "Password updated successfully"));
        } else {
            echo json_encode(array("status" => "false", "message" => "Error updating password: " . $con->error));
        }
    } else {
        // user_name does not exist; insert a new record with user_name and password
        $insert_sql = "INSERT INTO user_login (user_name, password) VALUES ('$user_name', '$password')";
        if ($con->query($insert_sql) === TRUE) {
            echo json_encode(array("status" => "true", "message" => "New user registered successfully"));
        } else {
            echo json_encode(array("status" => "false", "message" => "Error inserting new user: " . $con->error));
        }
    }
} else {
    echo json_encode(array("status" => "false", "message" => "user_name and password are required"));
}

$con->close();
?>

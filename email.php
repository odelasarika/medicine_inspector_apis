<?php
include 'connection.php';
date_default_timezone_set('Asia/Kolkata');

// Check if username, email, and password are provided
if (isset($_POST['user_name']) ||isset($_POST['email']) && isset($_POST['password'])) {
    $username = $con->real_escape_string($_POST['user_name']);
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    // Check if the email already exists in the database
    $select_sql = "SELECT * FROM user_login WHERE email = '$email'";
    $result = $con->query($select_sql);

    if ($result->num_rows > 0) {
        // Email exists; update the username and password
        $update_sql = "UPDATE user_login SET user_name = '$username', password = '$password' WHERE email = '$email'";
        if ($con->query($update_sql) === TRUE) {
            echo json_encode(array("status" => "true", "message" => "User details updated successfully"));
        } else {
            echo json_encode(array("status" => "false", "message" => "Error updating user details: " . $con->error));
        }
    } else {
        // Email does not exist; insert a new record with username, email, and password
        $insert_sql = "INSERT INTO user_login (user_name, email, password) VALUES ('$user_name', '$email', '$password')";
        if ($con->query($insert_sql) === TRUE) {
            echo json_encode(array("status" => "true", "message" => "New user registered successfully"));
        } else {
            echo json_encode(array("status" => "false", "message" => "Error inserting new user: " . $con->error));
        }
    }
} else {
    echo json_encode(array("status" => "false", "message" => "User_ name, email, and password are required"));
}

$con->close();
?>
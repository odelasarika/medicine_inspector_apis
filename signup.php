<?php
include 'connection.php';

// Check if username, email, and password are provided
if (isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $user_name = $con->real_escape_string($_POST['user_name']);
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    // Insert query
    $insert_sql = "INSERT INTO user_login (user_name, email, password) VALUES ('$user_name', '$email', '$password')";
    $result = $con->query($insert_sql);

    if ($result === TRUE) {
        echo json_encode(array("status" => "true", "message" => "Data inserted successfully"));
    } else {
        echo json_encode(array("status" => "false", "message" => "Error: " . $con->error));
    }
} else {
    echo json_encode(array("status" => "false", "message" => "Username, email, and password are required"));
}

$con->close();
?>

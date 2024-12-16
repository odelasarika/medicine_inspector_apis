<?php
include 'connection.php';
date_default_timezone_set('Asia/Kolkata');
$row = [];

// Check if email and password are provided
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    // Query to check if the email and password match an existing record
    $select_sql = "SELECT user_name, email FROM user_login WHERE email = '$email' AND password = '$password'";
    $result = $con->query($select_sql);

    if ($result->num_rows > 0) {
        // Fetch user details
        while ($data = $result->fetch_assoc()) {
            $row[] = $data;
        }
        echo json_encode(array(
            "status" => "true",
            "message" => "User found successfully.",
            "data" => $row
        ));
    } else {
        // Email or password is incorrect
        echo json_encode(array(
            "status" => "false",
            "message" => "Invalid email or password. Please try again."
        ));
    }
} else {
    // Missing email or password
    echo json_encode(array(
        "status" => "false",
        "message" => "Email and password are required."
    ));
}

// Close the database connection
$con->close();
?>


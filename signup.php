<?php
include 'connection.php';
date_default_timezone_set('Asia/Kolkata');

// Check if email and password are provided
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $con->real_escape_string($_POST["email"]);
    $password = $con->real_escape_string($_POST["password"]); // Store password as plain text (this is not recommended)

    // Check if the email already exists in the database
    $select_sql = "SELECT user_id, password FROM user_login WHERE email = '$email'";
    $result = $con->query($select_sql);

    if ($result === FALSE) {
        echo json_encode(array("status" => "false", "message" => "Error checking email: " . $con->error));
    } elseif ($result->num_rows > 0) {
        // Email exists; fetch the stored password and user_id
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        $user_id = $row['user_id'];

        // Compare the entered password with the stored password
        if ($password === $stored_password) {
            echo json_encode(array(
                "status" => "true",
                "message" => "Login successful",
                "user_id" => $user_id  // Include the user_id in the response
            ));
        } else {
            echo json_encode(array("status" => "false", "message" => "Incorrect password. Please use 'Forget Password' to reset."));
        }
    } else {
        // Email does not exist; insert the new email and plain-text password
        $insert_sql = "INSERT INTO user_login (email, password) VALUES ('$email', '$password')";

        if ($con->query($insert_sql) === TRUE) {
            // After successful insertion, get the new user's id
            $user_id = $con->insert_id; // Get the ID of the newly inserted user
            echo json_encode(array(
                "status" => "true",
                "message" => "New account created successfully",
                "user_id" => $user_id  // Show the incremented user_id in the response
            ));
        } else {
            echo json_encode(array("status" => "false", "message" => "Error inserting data: " . $con->error));
        }
    }
} else {
    echo json_encode(array("status" => "false", "message" => "Email or password not provided"));
}

$con->close();
?>





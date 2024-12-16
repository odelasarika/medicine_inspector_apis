<?php
// Include the database connection
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input and sanitize it
    $username_email = $con->real_escape_string($_POST["username_email"]);
    $password = $_POST["password"];

    // Check if the username/email exists in the database
    $select_sql = "SELECT * FROM user_login WHERE user_name = '$username_email' OR email = '$username_email'";
    $result = $con->query($select_sql);

    if ($result->num_rows > 0) {
        // Fetch the user data from the database
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session
            session_start();
            //$_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['user_name'] = $user['user_name']; // Store username in session

            // Redirect to the main page or dashboard
            header("Location: main_page.php");
            exit();
        } else {
            // Handle invalid password
            echo "Invalid username/email or password.";
        }
    } else {
        // Handle username/email not found
        echo "Invalid username/email or password.";
    }
}
?>


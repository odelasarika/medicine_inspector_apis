<?php
include 'connection.php';

// Check if 'health_condition' is set in POST
if (isset($_POST['health_condition'])) {
    // Sanitize the input to prevent SQL injection
    $health_condition = mysqli_real_escape_string($con, $_POST['health_condition']);

    // SQL query to fetch the medicine name, type, and generic name
    $select_sql = "SELECT medicine_name, type, generic_name FROM medicine WHERE health_condition = '$health_condition'";

    $result = $con->query($select_sql);
    $medicines = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $medicines[] = $row;
        }
        echo json_encode([
            "status" => "true",
            "message" => "Data retrieved successfully",
            "Data" => $medicines
        ]);
    } else {
        echo json_encode([
            "status" => "false",
            "message" => "No data found for the specified health condition"
        ]);
    }

    // Close the connection
    $con->close();
} else {
    echo json_encode([
        "status" => "false",
        "message" => "Health condition not provided"
    ]);
}
?>

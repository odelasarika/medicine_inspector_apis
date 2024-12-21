<?php
// Define the response function
function response($message, $data, $status) {
    echo json_encode(["status" => $status, "msg" => $message, "data" => $data]);
    exit(); // Ensure the script stops after sending the response
}
?>
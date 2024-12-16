<?php

include 'connection.php';
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');


// Modified SQL query based on your table structure
$insert_sql = "INSERT INTO medicine
    ( medicine_name, generic_name, composition, type, manufacture)
    VALUES
    ('" . $_POST["medicine_name"] . "',
   '" . $_POST["generic_name"] . "',
   '" . $_POST["composition"] . "',
  '" . $_POST["type"] . "',
   
     ' . manufacture.')";

if ($con->query($insert_sql) === TRUE) {
    echo json_encode(array("status" => "true", "message" => "Data inserted successfully"));
} else {
    echo json_encode(array("status" => "false", "message" => "Error: " . $con->error));
}

$con->close();
?>

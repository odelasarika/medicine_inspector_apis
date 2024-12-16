<?php


    include 'connection.php';
   
    $select_sql= "SELECT * FROM medicine WHERE medicine_name ='".$_POST["medicine_name"]."'";


    $result = $con->query($select_sql);
   
    if ($result->num_rows > 0)
    {
        while ($row[] = $result->fetch_assoc())
        {
            $questions = $row;
            $jsonData = json_encode($questions);
        }
        echo $jsonData;
    }
    else
        echo "No Data Found";
   
    $con->close(); 
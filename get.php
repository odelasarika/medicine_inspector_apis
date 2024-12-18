<?php


    include 'connection.php';
   
    $select_sql= "SELECT * FROM medicine WHERE medicine_name ='".$_POST["medicine_name"]."'";

     $row=[];
    $result = $con->query($select_sql);
   
    if ($result->num_rows > 0)
    {
        while ($data = $result->fetch_assoc())
        {
            if($data!=null){
                $row[] =$data;
            }
        }
        echo json_encode(array("status"=>"true","message" => "Data inserted successfully","Data" => $row));;
    }
    else
        echo json_encode(array("status"=>"false","message"=>"data doesnt exist in database "));
   
    $con->close(); 
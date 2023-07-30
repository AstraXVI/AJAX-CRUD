<?php
require "db.php";


$id = $_POST['id'];
$status = $_POST['status'];

if ($status == "inComplete") {
    $updateStatus = "UPDATE `tasks` SET `status`='completed' WHERE id='$id'";
}else{
    $updateStatus = "UPDATE `tasks` SET `status`='inComplete' WHERE id='$id'";
}


$conn->query($updateStatus);

// header("Refresh: 0");


// echo $status;



?>
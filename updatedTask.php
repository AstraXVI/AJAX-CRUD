<?php 
require "db.php";

$id = $_POST['id'];
$task = $_POST["task"];
$date = $_POST["date"];

$updateTask = "UPDATE `tasks` SET `task`='$task',`due`='$date' WHERE id='$id'";

$list = $conn->query($updateTask);


?>
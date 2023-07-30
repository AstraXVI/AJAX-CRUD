<?php 

require "db.php";

$task = $_POST["task"];
$date = $_POST["date"];

$query = "INSERT INTO `tasks` (`task`,`status`, `due`) VALUES ('$task','inComplete','$date')";

$conn->query($query);

?>
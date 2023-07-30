<?php
    require 'db.php';

    $id = $_POST['id'];

      
      $delete_item = "DELETE FROM `tasks` WHERE id = '$id'";
    
      $conn->query($delete_item);
?>
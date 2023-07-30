<?php 
require "db.php";

$id = $_POST['id'];

$retrieve = "SELECT * FROM `tasks` WHERE id='$id'";

$list = $conn->query($retrieve);
$fetch = $list->fetch_assoc();

?>

<div class="add-items d-flex">
    <input type="text" class="form-control todo-list-input" value="<?php echo $fetch['task'] ?>" id="updateTask" placeholder="Add Task here..">
    <input type="date" class="ml-2 p-1" value="<?php echo $fetch['due'] ?>" style="opacity: 0.7;" name="date" id="updateDate">
    <input type="hidden" id="hidden" value="<?php echo $fetch['id'] ?>">
</div>

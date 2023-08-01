<?php 
require "db.php";

$filterValue = $_POST['filterValue'];

if($filterValue == "completed"){
    $sql = "SELECT * FROM tasks WHERE status='completed'";
}
elseif ($filterValue == "inComplete") {
    $sql = "SELECT * FROM tasks WHERE status='inComplete'";
}
else{
    $sql = "SELECT * FROM tasks";
}

$list = $conn->query($sql);
$fetchTask = $list->fetch_assoc();

// echo $filterValue;

?>

<?php  if($list->num_rows) { ?>
    <?php do{ ?>
        <li class="<?php echo $fetchTask['status'] ?>">
            <div data-id="<?php echo $fetchTask['id'] ?>" data-Status="<?php echo $fetchTask['status'] ?>" class="form-check updateStatus">
                <label class="form-check-label"> 
                    <input class="checkbox" type="checkbox" <?php echo $fetchTask['status'] == 'completed' ? "checked" : "" ?>><?php echo $fetchTask['task'] ?> 
                    <i class="input-helper"></i>
                </label>
            </div> 
            <div class="ml-auto">
                <i data-id="<?php echo $fetchTask['id'] ?>"class="editTask fa-solid fa-pen text-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                </i> 
                <i data-id="<?php echo $fetchTask['id'] ?>" class="remove removeTask mdi mdi-close-circle-outline"></i>
            </div>
        </li>
    <?php } while($fetchTask = $list->fetch_assoc()) ?>
<?php } else { ?>
    <p class="text-center text-secondary">No Tasks.</p>
<?php } ?>
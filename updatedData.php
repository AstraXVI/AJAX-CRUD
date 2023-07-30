<?php
require "db.php";

$retrieve = 'SELECT * FROM `tasks`';

$list = $conn->query($retrieve);
$fetch = $list->fetch_assoc();

?>

<?php if($list->num_rows) { ?>
    <?php do{ ?>
        <li class="<?php echo $fetch['status'] ?>">
            <div data-id="<?php echo $fetch['id'] ?>" data-Status="<?php echo $fetch['status'] ?>" class="form-check updateStatus">
                <label class="form-check-label"> 
                    <input class="checkbox" type="checkbox" <?php echo $fetch['status'] == 'completed' ? "checked" : "" ?>><?php echo $fetch['task'] ?> 
                    <i class="input-helper"></i>
                </label>
            </div> 
            <div class="ml-auto">
                <i data-id="<?php echo $fetch['id'] ?>"class="editTask fa-solid fa-pen text-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                </i> 
                <i data-id="<?php echo $fetch['id'] ?>" class="remove removeTask mdi mdi-close-circle-outline"></i>
            </div>
        </li>
    <?php } while($fetch = $list->fetch_assoc()) ?>
<?php } else { ?>
    <p class="text-center text-secondary">No Tasks.</p>
<?php } ?>
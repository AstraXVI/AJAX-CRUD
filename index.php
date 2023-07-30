<?php
require "db.php";

$retrieve = 'SELECT * FROM `tasks`';

$list = $conn->query($retrieve);
$fetch = $list->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"> -->
    <link rel="stylesheet" href="style.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <title>CRUD</title>
</head>
<body>
    
    <div class="col-6 mx-auto mt-5">
        <h1 class="text-center mb-5 pb-4">Task Manager</h1>
        <div class="add-items d-flex">
            <input type="text" class="form-control todo-list-input" id="task" placeholder="Add Task here..">
            <input type="date" class="ml-2 p-1" style="opacity: 0.7;" name="date" id="date">
            <!-- <input id="startDate" class="form-control" type="date" /> -->
            <button id='add' class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button>
        </div>

        <!-- View options section -->
    <div class="d-flex justify-content-end mb-4">
        <div class="col-auto d-flex align-items-center">
            <label class="text-secondary my-2 pr-2 view-opt-label">Filter</label>
            <select id="filterTask" class="custom-select custom-select-sm my-2">
                <option value="all" selected>All</option>
                <option value="completed">Completed</option>
                <option value="inComplete">In Complete</option>
            </select>
        </div>
        <div class="col-auto d-flex align-items-center px-1">
            <label class="text-secondary my-2 pr-2 view-opt-label">Sort</label>
            <select class="custom-select custom-select-sm my-2">
                <option value="added-date-asc" selected>Added date</option>
                <option value="due-date-desc">Due date</option>
            </select>
        </div>
    </div>

        <div id='tasks'></div>
        <div class="list-wrapper">
            <ul class="d-flex flex-column-reverse todo-list">
                <!-- <li>
                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> For what reason would it be advisable. <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                </li> -->
                <!-- <li class="completed">
                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> For what reason would it be advisable for me to think. <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                </li>
                <li>
                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> it be advisable for me to think about business content? <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                </li> -->
                <div id="wrapper">
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
                </div>
            </ul>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="updateTaskModal" class="modal-body">
            <!-- modal body -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateBtn" data-bs-dismiss="modal">Update</button>
            </div>
            </div>
        </div>
    </div>


    <script>
        $(function(){
            $("#add").click(function(){
                const task = $("#task").val()
                const date = $("#date").val()
                
                if(task && date){
                    $.ajax({
                        url: "addTask.php",
                        method: "post",
                        data: {
                            task,
                            date
                        },
                        success(){
    
                            // $("#wrapper").load("updatedData.php")
                            $("#wrapper").load("updatedData.php")
    
                            Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Task Successfully Added',
                            showConfirmButton: false,
                            timer: 1200
                            })
                            
                            $("#task").val("")
                            $("#date").val("")
                            
                        }
                    })
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill up the task!'
                    })
                }

            })

            // deleteTask
            $("#wrapper").on("click",".removeTask", function(){
                const id = $(this).data("id");
                
                $.ajax({
                    url: "deleteTask.php",
                    method: "post",
                    data: {
                        id
                    },
                    success(){
                        $("#wrapper").load("updatedData.php")

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Task Deleted',
                            showConfirmButton: false,
                            timer: 1200
                            })
                        // console.log(e)

                    }
                })
            })

            // Update Status

            $("#wrapper").on("click",'.updateStatus', function(){
                const id = $(this).data("id");
                const status = $(this).data("status");

                $.ajax({
                    url:"updateTaskStatus.php",
                    method: "post",
                    data:{
                        id,
                        status
                    },
                    success(){
                        $("#wrapper").load("updatedData.php");
                        // $(".updateStatus").load("updateTaskStatus.php");
                    }
                })
                
            })

            // Edit task

            $("#wrapper").on("click",'.editTask', function(){
                const id = $(this).data("id");

                $.ajax({
                    url:"updateTaskModal.php",
                    method: "post",
                    data:{
                        id
                    },
                    success(e){
                        $('#updateTaskModal').html(e);
                       
                    }
                })
                
            })

            $(".updateBtn").click( function(){
                const id = $("#hidden").val();
                const task = $("#updateTask").val();
                const date = $("#updateDate").val();

                $.ajax({
                    url:"updatedTask.php",
                    method: "post",
                    data:{
                        id,
                        task,
                        date
                    },
                    success(){
                        $("#wrapper").load("updatedData.php");

                       
                    }
                })
                
            })

            


        })
    </script>
    <!-- <script src="script.js"></script> -->
</body>
</html>































<!-- <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Awesome Todo list</h4>
                        <div class="add-items d-flex"> <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> <button class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button> </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> For what reason would it be advisable. <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> For what reason would it be advisable for me to think. <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> it be advisable for me to think about business content? <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> Print Statements all <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> Call Rampbo <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> Print bills <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Todo</title>
</head>
<body>

<!-- Header -->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h3 class="my-0 mr-md-auto font-weight-bold">Hi <?php echo $_SESSION['username'];?> </h3>
    <a class="btn btn-outline-primary" href="/todoList/auth/logout.php">Logout</a>
</div>

<!-- Template -->

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="column container d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title"> Todo list</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="add-items d-flex"> 
                                <input type="text" class="form-control todo-list-input" required="required" name = "description" placeholder="What do you need to do today?"> 
                                <button class="add btn btn-primary font-weight-bold todo-list-add-btn" type="submit">Add</button> 
                            </div>
                        </form>
                        <span class="err">
                            <?php 
                                if(isset($_SESSION['errormsg'])) {
                                    echo $_SESSION['errormsg'];
                                    unset($_SESSION['errormsg']);
                                }
                            ?>
                        </span>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <?php 
                                    while($rows = mysqli_fetch_assoc($retval_tasks)) {
                                        $task = new Task($rows['description'], $rows['completed']);
                                        ?>
                                            <li <?php if($task->isCompleted()) { ?> class="completed" <?php } ?>>
                                                <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" <?php if($task->isCompleted()) { ?> checked="" <?php } ?>> <?php echo $task->getDescription(); ?> <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                            </li>                                 
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Template -->

    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
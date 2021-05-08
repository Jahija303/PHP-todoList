<?php

    //Database functions
    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';

    //Database connection
    $conn = connectToServer();
    //Create database and table if they do not exist
    createDB($conn,'todo');
    useDB($conn, 'todo');
    createUsersTable($conn);
    createTaskTable($conn);

    //Required files
    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/auth/auth_session.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/model/task.php';

    //Select users tasks
    $retval_tasks = selectUserTasks($conn,$_SESSION['user_id']);

    if(isset($_REQUEST['description'])) {

        $description = test_input($_POST["description"]);

        $user_id = $_SESSION['user_id'];
        $retval = insertIntoTask($conn, $description, $user_id);

        if($retval) {
            header("Location: /todoList/index.php");
        } else {
            $_SESSION['errormsg'] = "Cannot create task";
            header("Location: /todoList/index.php");
        }

    } else {
        require $_SERVER['DOCUMENT_ROOT'] . '/todoList/views/index.view.php';
    }

    closeConnection($conn);
?>
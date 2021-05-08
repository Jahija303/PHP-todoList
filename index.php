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
    $retval = selectUserTasks($conn,$_SESSION['user_id']);
    

    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/views/index.view.php';


    closeConnection($conn);
?>
<?php 
    $task_id = $_GET['id'];

    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';

    $conn = connectToServer();
    useDB($conn, 'todo');

    $retval = deleteTask($conn, $task_id);

    if($retval) {
        echo "Database Updated, TaskID = '$task_id' Deleted";
    } else {
        echo "Error, Unable to update the database";
    }
?>
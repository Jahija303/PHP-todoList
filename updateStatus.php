<?php 
    $task_id = $_GET['id'];
    $completed = intval($_GET['completed']);

    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';

    $conn = connectToServer();
    useDB($conn, 'todo');

    $retval = toggleTaskCompleted($conn, $task_id, $completed);

    if($retval) {
        echo "Database Updated, TaskID = '$task_id' is set to completed = '$completed'";
    } else {
        echo "Error, Unable to update the database";
    }

?>

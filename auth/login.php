<?php

require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';
$conn = connectToServer();
useDB($conn, 'todo');

session_start();

if(isset($_REQUEST['username'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $username = test_input($_POST["username"]);
       $password = md5(test_input($_POST["password"]));
    }
    
    $retval = checkIfUserExists($conn, $username, $password);

    if(mysqli_num_rows($retval) == 1) {
        
        $row = mysqli_fetch_assoc($retval);
        
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $username;

        header("Location: /todoList/index.php");

    } else {
        $_SESSION['errormsg'] = "Invalid username or password";
        header("Location: /todoList/auth/login.php");
    }
} else {

    require $_SERVER['DOCUMENT_ROOT'] . '/todoList/views/auth/login.view.php';

}

closeConnection($conn);
?>

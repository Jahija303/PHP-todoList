<?php
    session_start();
    if(session_destroy()) {
        header("Location: /todoList/auth/login.php");
    }
?>
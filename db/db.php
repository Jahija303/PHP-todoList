<?php 

function connectToServer() {

    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
         
    if(!$conn) {
        echo 'Could not connect';
    }
    
    return $conn;
}

function closeConnection($conn) {
    mysqli_close($conn);
}

function createDB($conn,$name) {
    $sql = "CREATE DATABASE IF NOT EXISTS $name";
    $retval = mysqli_query( $conn, $sql );
         
    if(!$retval) {
        die('Could not create database: ' . mysqli_error($conn));
    }
}

function dropDB($conn) {
    $sql = 'DROP DATABASE TODO';
    $retval = mysqli_query( $conn, $sql );
         
    if(!$retval) {
        die('Could not drop database: ' . mysqli_error($conn));
    }
}

function useDB($conn,$name) {
    mysqli_select_db($conn,$name);
}

function createUsersTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS user(".
        "user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
        "username NVARCHAR(20) NOT NULL,".
        "password NVARCHAR(200) NOT NULL,".
        "email NVARCHAR(20) NOT NULL);";
    $retval = mysqli_query($conn, $sql);

    if(!$retval) {
        die('Could not create table user: ' . mysqli_error($conn));
    }
}

function createTaskTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS task(".
        "task_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
        "user_id INT NOT NULL,".
        "description NVARCHAR(20) NOT NULL,".
        "completed TINYINT DEFAULT(0));";
    $retval = mysqli_query($conn, $sql);

    if(!$retval) {
        die('Could not create table task: ' . mysqli_error($conn));
    }
}

function insertIntoUser($conn, $username, $password, $email) {
    $sql = "INSERT INTO user (username, password, email)".
    "VALUES ('$username', '$password', '$email')";
    $retval = mysqli_query($conn, $sql);

    if(!$retval) {
        die('Could not insert data into table user: ' . mysqli_error($conn));
    }
    
    return $retval;
}

function checkIfUserExists($conn, $username, $password) {
    $sql = "SELECT * FROM todo.user WHERE username = '$username' AND password = '$password'";
    $retval = mysqli_query($conn, $sql);

    if(!$retval) {
        die('Could not retrieve data from table user: ' . mysqli_error($conn));
    }

    return $retval;
}

function selectUserTasks($conn, $user_id) {
    $sql = "SELECT * FROM todo.task WHERE user_id = '$user_id'";
    $retval = mysqli_query($conn, $sql);

    if(!$retval) {
        die('Could not select data from table tasks: ' . mysqli_error($conn));
    }
    
    return $retval;
}

?>
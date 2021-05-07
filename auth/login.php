<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    
<?php

require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';
$conn = connectToServer();
useDB($conn, 'todo');

session_start();

if(isset($_REQUEST['username'])) {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

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

?>

<div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <h2 class="text-center">Log in</h2>
            <span class="err">
                <?php 
                    if(isset($_SESSION['errormsg'])) {
                        echo $_SESSION['errormsg'];
                        unset($_SESSION['errormsg']);
                    }
                ?>
            </span> 
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required" name = "username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name = "password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="/todoList/auth/registration.php">Create an Account</a></p>
</div>

<?php
}

closeConnection($conn);
?>

</body>
</html>
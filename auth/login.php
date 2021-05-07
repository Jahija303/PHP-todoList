<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
<?php

require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';
$conn = connectToServer();
useDB($conn, 'todo');

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
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $username;

        header("Location: /todoList/index.php");

    } else {
        echo "<div class='form'>
              <h3>Incorrect Username/password.</h3><br/>
              <p class='link'>Click here to <a href='/todoList/auth/login.php'>Login</a> again.</p>
              </div>";
    }
} else {
    ?>

        <h2>Login</h2>
      
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>Username:</td> 
                    <td><input type = "text" name = "username"></td>
                </tr>
                
                <tr>
                    <td>Password:</td>
                    <td><input type = "password" name = "password"></td>
                </tr>

                <tr>            
                    <td><input type = "submit" name = "submit" value = "Submit"></td>                   
                </tr>

                <tr>
                    <td><p><a href="/todoList/auth/registration.php">New Registration</a></p></td>
                </tr>
            </table>
        </form>

    <?php
}

closeConnection($conn);

?>

</body>
</html>
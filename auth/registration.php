<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
      <?php
    
        require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';
        $conn = connectToServer();
        useDB($conn, 'todo');

        $username = $password = $email = "";
        $usernameErr = $passwordErr = $emailErr = "";
        $result = "";

         if(isset($_REQUEST["username"])) { 
         
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
             }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if(empty($_POST["username"])) {
                    $usernameErr = "Username is required";
                } else {
                    $username = test_input($_POST["username"]);
                }

                if(empty($_POST["password"])) {
                    $passwordErr = "Password is required";
                } else {
                    $password = md5(test_input($_POST["password"]));
                }
               
                if(empty($_POST["email"])) {
                    $emailErr = "Email is required";
                } else {
                    $email = test_input($_POST["email"]);
                }
               
            }

            if($usernameErr == "" && $passwordErr == "" && $emailErr == "") {
                $result = insertIntoUser($conn, $username, $password, $email);
            }

            if($result) {
                echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='/todoList/auth/login.php'>Login</a></p>
                  </div>";
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='/todoList/auth/registration.php'>register</a> again.</p>
                      </div>";
            }
         } else {
          ?>
                <h2>Registration</h2>
                
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
                        <td>E-Mail:</td>
                        <td><input type = "text" name = "email"></td>
                        </tr>

                        <tr>
                        <td>
                            <input type = "submit" name = "submit" value = "Submit"> 
                        </td>
                        </tr>
                    </table>
                </form>
             <?php
         }
        
        closeConnection($conn);

            ?>

</body>
</html>
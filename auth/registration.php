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
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $username;
                
                header("Location: /todoList/index.php");
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='/todoList/auth/registration.php'>register</a> again.</p>
                      </div>";
            }
         } else {
          ?>

            <div class="login-form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <h2 class="text-center">Log in</h2>       
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" required="required" name = "username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required="required" name = "password">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" required="required" name = "email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <div class="clearfix">
                        <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                        <a href="#" class="float-right">Forgot Password?</a>
                    </div>        
                </form>
                <p class="text-center"><a href="/todoList/auth/login.php">Login</a></p>
            </div>

             <?php
         }
        
        closeConnection($conn);

            ?>

</body>
</html>
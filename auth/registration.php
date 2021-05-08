    <?php
    
        require $_SERVER['DOCUMENT_ROOT'] . '/todoList/db/db.php';
        $conn = connectToServer();
        useDB($conn, 'todo');

        $username = $password = $email = "";
        $usernameErr = $passwordErr = $emailErr = "";
        $result = "";

         if(isset($_REQUEST["username"])) { 

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

                $retval = checkIfUserExists($conn, $username, $password);

                if(mysqli_num_rows($retval) == 1) {
                    $row = mysqli_fetch_assoc($retval);
        
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $username;

                    header("Location: /todoList/index.php");
                }
                
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='/todoList/auth/registration.php'>register</a> again.</p>
                      </div>";
            }
         } else {
        
            require $_SERVER['DOCUMENT_ROOT'] . '/todoList/views/auth/registration.view.php';

         }
        
        closeConnection($conn);

    ?>

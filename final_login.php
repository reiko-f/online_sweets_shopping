<?php 
    include_once 'final_header.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>  
        <style>

            body {
                background-color: #FFFFC2;
            }

            form {
                padding: 20px;
                width: 400px;
                background-color: #FBFBF9;
                border-radius: 15px;
            }

        </style>
        <title>Login Form</title>
    </head>
    <body>
        <div class="login-form">
            <h1>Login</h1>
            <form action="includes/final_login.inc.php" method="POST">

                <label for="username">Username</label>
                <input type="text" name="username"><br><br>

                <label for="password">Password</label>
                <input type="password" name="password"><br><br>
            
                <button type="submit" name="login">Login</button>

            </form><br>
            <p>Do not have an account yet?<a href="final_register.php"><button>Go to Register</button></a></p>
        </div>

        <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'emptyinput') {
                    echo '<p style="color:hotpink;font-size:2em">Fill in all fields!</p>';
                } else if ($_GET['error'] == 'wrongusername') {
                    echo '<p style="color:hotpink;font-size:2em">Incorrect username!</p>'; 
                } else if ($_GET['error'] == 'wrongpassword') {
                    echo '<p style="color:hotpink;font-size:2em">Incorrect password!</p>';             
                } 
            }

            // require_once 'includes/final_dbh.inc.php';
            // require_once 'includes/final_functions.inc.php';           
                        
            // echo '<p> ' . usernameExists($connect, 'user3', 'user')['password'] . '</p><br>';            
            // $password = 'user3';
            // // $hashed = usernameExists($connect, 'user2', 'user2')['password'];            
            // $test = password_verify($password, $hashed);
            
            // if ($test == true) {
            //     echo 'Valid';
            // } else {
            //     echo 'Not valid';
            // }

            ?>        
       
    </body>
</html>
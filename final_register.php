<?php 
    include_once 'final_header.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>

            body {
                background-color: #F0FFF0;
            }

            form {
                padding: 20px;
                width: 400px;
                background-color: #FBFBF9;
                border-radius: 15px;
            }

        </style>
        <title>Register Form</title>
    </head>
    <body>
        <div class="register-form">
            <h1>Register</h1>
            <form action="includes/final_register.inc.php" method="POST">

                <label for="username">Username</label>
                <input type="text" name="username"><br><br>

                <label for="password">Password</label>
                <input type="password" name="password"><br><br>

                <label for="re_password">Retype Password</label>
                <input type="password" name="re_password"><br><br>

                <label for="firstname">First Name</label>
                <input type="text" name="firstname"><br><br>

                <label for="lastname">Last Name</label>
                <input type="lastname" name="lastname"><br><br>

                <label for="email">Email</label>
                <input type="email" name="email"><br><br>

                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="phoneNumber"><br><br>

                <label for="address">Address</label>
                <input type="text" name="address"><br><br>

                <button type="submit" name="register">Register</button><br><br>

            </form><br>
            <p>Already have an account?<a href="final_login.php"><button>Go to Login</button></a></p>
        </div>

            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'emptyinput') {
                    echo '<p style="color:hotpink;font-size:2em">Fill in all fields!</p>';
                } else if ($_GET['error'] == 'invalidusername') {
                    echo '<p style="color:hotpink;font-size:2em">Choose a proper username!</p>';                
                } else if ($_GET['error'] == 'invalidemail') {
                    echo '<p style="color:hotpink;font-size:2em">Choose a proper email!</p>';
                } else if ($_GET['error'] == 'passwordsdontmatch') {
                    echo '<p style="color:hotpink;font-size:2em">Passwords do not match!</p>';
                } else if ($_GET['error'] == 'stmtfailed') {
                    echo '<p style="color:hotpink;font-size:2em">Something went wrong!</p>';
                } else if ($_GET['error'] == 'usernameexists') {
                    echo '<p style="color:hotpink;font-size:2em">Username already taken!</p>';
                } else if ($_GET['error'] == 'none') {
                    echo '<p style="color:hotpink;font-size:2em">You have registered successfully!</p>';
                }
            }
            ?>      
        
    </body>
</html>
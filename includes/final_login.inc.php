<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login.inc</title>
    </head>
    <body>
        <h1>Login</h1>    
    </body>
</html>

<?php

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        require_once 'final_dbh.inc.php';
        require_once 'final_functions.inc.php';

        if (emptyInputLogin($username, $password) !== false) {
            header("location: ../final_login.php?error=emptyinput");
            exit();
        }

        loginUser($connect, $username, $password);

    } else {
        header("location: ../final_shop.php");        
        exit();
    }

?>
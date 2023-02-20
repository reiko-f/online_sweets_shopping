<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register.inc</title>
    </head>
    <body>     
        <h1>Register</h1>
    </body>
</html>

<?php 
    // $connect = mysqli_connect('localhost', 'root', '', 'loginsystem') or die('Unable to connect' . mysqli_connect_error());

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber']; 
        $address = $_POST['address'];
      
        require_once 'final_dbh.inc.php';
        require_once 'final_functions.inc.php';

        if (emptyInputRegister($username, $password, $re_password, $firstname, $lastname, $email, $phoneNumber, $address) !== false) {
            header("location: ../final_register.php?error=emptyinput");
            exit();
        } 

        if (invalidUsername($username) !== false) {
            header("location: ../final_register.php?error=invalidusername");
            exit();
        }
        
        if (invalidEmail($email) !== false) {
            header("location: ../final_register.php?error=invalidemail");
            exit();
        }

        if (passwordMatch($password, $re_password) !== false) {
            header("location: ../final_register.php?error=passwordsdontmatch");
            exit();
        }
    
        if (usernameExists($connect, $username, $email) !== false) {
            header("location: ../final_register.php?error=usernameexists");
            exit();
        }

        createUser($connect, $username, $password, $firstname, $lastname, $email, $phoneNumber, $address);
               
    } else {
        header("location: ../final_register.php");
        exit(); 
    }

    
?>

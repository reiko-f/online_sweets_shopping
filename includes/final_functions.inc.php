<?php
    
    function emptyInputRegister($username, $password, $re_password, $firstname, $lastname, $email, $phoneNumber, $address) {
        $result = false;

        if (empty($username) || empty($password) || empty($re_password) || empty($firstname) || empty($lastname) || empty($email) || empty($phoneNumber) || empty($address)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    
    function invalidUsername($username) {
        $result = false;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email) {
        $result = false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function passwordMatch($password, $re_password) {
        $result = false;

        if ($password !== $re_password) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
        
    function usernameExists($connect, $username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
        $stmt = mysqli_stmt_init($connect);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../final_register.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;

        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($connect, $username, $password, $firstname, $lastname, $email, $phoneNumber, $address) {
        $sql = "INSERT INTO users (username, password, firstname, lastname, email, phoneNumber, address) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($connect);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../final_register.php?error=stmtfailed");
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssssss", $username, $hashedPassword, $firstname, $lastname, $email, $phoneNumber, $address);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        
        header("location: ../final_register.php?error=none");       
        exit();
    }


    function emptyInputLogin($username, $password) {
        $result = false;

        if (empty($username) || empty($password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
 
    function loginUser($connect, $username, $password) {

        $usernameExists = usernameExists($connect, $username, $username);
        
        if ($usernameExists == false) {
            header("location: ../final_login.php?error=wrongusername");
            exit();
        }

        $passwordHashed = $usernameExists['password'];

        $passwordVerified = password_verify($password, $passwordHashed);

        if ($passwordVerified == false) {
            header("location: ../final_login.php?error=wrongpassword");
            exit();
            
        } else if ($passwordVerified == true) {
            session_start();
            $_SESSION['user_id'] = $usernameExists['user_id'];
            $_SESSION['username'] = $usernameExists['username'];
            $_SESSION['firstname'] = $usernameExists['firstname'];
            $_SESSION['lastname'] = $usernameExists['lastname'];
            $_SESSION['email'] = $usernameExists['email'];
            $_SESSION['phoneNumber'] = $usernameExists['phoneNumber'];
            $_SESSION['address'] = $usernameExists['address'];

            // header("location: ../final_index.php");
            header("location: ../final_shop.php");
            exit();       
        }                
    }

?>
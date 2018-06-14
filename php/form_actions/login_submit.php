<?php
    session_start();
    include_once('../dbDriver.php');

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $existingUserRow = dbDriver::executeQuery("SELECT * FROM users WHERE email='".$email."' LIMIT 1");

    if($existingUserRow === null) {
        $_SESSION['notification'] = "Your username could not be found.";
        $_SESSION['notification_type'] = "error"; 
        $_SESSION['showPage'] = "login"; 
        header("Location: ../../index.php");
    } else {
        if(md5($password) == $existingUserRow[0]['password']) {
            $_SESSION['notification'] = "You have been successfully authenticated.";
            $_SESSION['notification_type'] = "success"; 
            $_SESSION['logged_in'] = true;
            header("Location: ../../index.php");
        } else {
            $_SESSION['notification'] = "Your password is incorrect.";
            $_SESSION['notification_type'] = "error"; 
            $_SESSION['showPage'] = "login"; 
            header("Location: ../../index.php");
        }
    }

    exit();
?>
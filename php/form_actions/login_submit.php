<?php
    session_start();
    include_once('../dbDriver.php');

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $existingUserRow = dbDriver::executeQuery("SELECT * FROM users WHERE email='".$email."' LIMIT 1");

    if($existingUserRow === null) {
        header("Location: ../../login.php");
    } else {
        if(md5($password) == $existingUserRow[0]['password']) {
            $_SESSION['notification'] = "Ati fost autentificat cu succes. Bun venit!";
            $_SESSION['notification_type'] = "success"; 
            $_SESSION['logged_in'] = true;
            header("Location: ../../index.php");
        } else {
            $_SESSION['notification'] = "Username sau parola gresita";
            $_SESSION['notification_type'] = "error"; 
            header("Location: ../../login.php");
        }
    }

    exit();
?>
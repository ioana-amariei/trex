<?php
    include_once('../dbDriver.php');

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $existingUserRow = dbDriver::executeQuery("SELECT * FROM users WHERE email='".$email."' LIMIT 1");

    if($existingUserRow === null) {
        header("Location: ../../login.php");
    } else {
        if(md5($password) == $existingUserRow[0]['password']) {
            header("Location: ../../index.php");
        } else {
            header("Location: ../../login.php");
        }
    }

    exit();
?>
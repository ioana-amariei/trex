<?php
    session_start();
    include_once('../dbDriver.php');

    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $password = $_REQUEST['password'];
    $password_repeat = $_REQUEST['passwordRepeat'];
    $email = $_REQUEST['email'];

    $row = array();

    $row['email'] = $email;
    $row['password'] = md5($password);
    $row['fname'] = $firstName;
    $row['lname'] = $lastName;

    $existingUserRow = dbDriver::executeQuery("SELECT * FROM users WHERE email='".$email."' LIMIT 1");

    if(strlen($firstName) < 1 || 
       strlen($lastName) < 1 || 
       strlen($password) < 1 || 
       strlen($password_repeat) < 1 || 
       strlen($email) < 1) 
    {
        $_SESSION['notification'] = "You must complete all fields in order to register.";
        $_SESSION['notification_type'] = "error"; 
        $_SESSION['showPage'] = "register"; 
        header("Location: ../../index.php");
        die();
    }

    if($password !== $password_repeat) {
        $_SESSION['notification'] = "The two passwords do not match.";
        $_SESSION['notification_type'] = "error"; 
        $_SESSION['showPage'] = "register"; 
        header("Location: ../../index.php");
        die();
    }

    if($existingUserRow === null) {
        DbDriver::insertInto('users', $row);
        $_SESSION['notification'] = "Your account has been successfully created.";
        $_SESSION['notification_type'] = "success"; 
        $_SESSION['logged_in'] = true;
        header("Location: ../../index.php");
    } else {
        $_SESSION['notification'] = "The e-mail is already in use.";
        $_SESSION['notification_type'] = "error"; 
        $_SESSION['showPage'] = "register"; 
        header("Location: ../../index.php");
    }

    exit();
?>
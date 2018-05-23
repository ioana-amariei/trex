<?php
    session_start();
    include_once('../dbDriver.php');

    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $password = $_REQUEST['password'];
    $email = $_REQUEST['email'];

    $row = array();

    $row['email'] = $email;
    $row['password'] = md5($password);
    $row['fname'] = $firstName;
    $row['lname'] = $lastName;

    $existingUserRow = dbDriver::executeQuery("SELECT * FROM users WHERE email='".$email."' LIMIT 1");

    if($existingUserRow === null) {
        DbDriver::insertInto('users', $row);
        $_SESSION['notification'] = "Contul dvs. a fost creat cu succes";
        $_SESSION['notification_type'] = "success"; 
        $_SESSION['logged_in'] = true;
        header("Location: ../../index.php");
    } else {
        $_SESSION['notification'] = "Aceasta adresa de e-mail este deja inregistrata in baza noastra de date.";
        $_SESSION['notification_type'] = "error"; 
        header("Location: ../../register.php");
    }

    exit();
?>
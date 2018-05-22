<?php
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
        header("Location: ../../index.php");
    } else {
        header("Location: ../../register.php");
    }

    exit();
?>
<?php
    session_start();

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        unset($_SESSION['logged_in']);
        $_SESSION['notification'] = "Ati fost deautentificat.";
        $_SESSION['notification_type'] = "success";
        header("Location: ../index.php");
    }
?>
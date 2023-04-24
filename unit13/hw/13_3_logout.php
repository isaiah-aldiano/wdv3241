<?php 
    // Destroy the session and log the user out
    unset($_SESSION['logged_in']);
    unset($_SESSION['valid_user']);
    session_destroy();

    header('Location: 13_2_login.php');

?>
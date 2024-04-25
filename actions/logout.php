<?php
// Start or resume the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

header("Location: ../pages/account/login.php");
    exit();
?>
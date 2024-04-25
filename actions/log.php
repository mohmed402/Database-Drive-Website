<?php 
session_start(); // Start or resume the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: ../account/login.php");
    exit();
}

// Access user information stored in $_SESSION
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$account_type = $_SESSION['account_type'];
?>
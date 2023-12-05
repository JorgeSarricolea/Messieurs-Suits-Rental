<?php
include '../database/connection.php';

session_start();

// Check if the user's session is active
if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    // Session is not active, redirect to login page
    header("Location: ./login.php");
    exit();
}

// Testing
echo 'Hola, ' . $_SESSION['user_name'] . '!';
?>
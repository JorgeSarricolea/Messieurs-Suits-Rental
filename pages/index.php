<?php
include '../database/connection.php';

session_start();

/* // Check if the user's session is active
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Session is not active, redirect to login page
    header("Location: ./login.php");
    exit();
} */

include '../includes/header.php';

// Testing
echo 'Hola, ' . $_SESSION['user_id'] . '!';
?>


<?php
session_start();

// Check if the user is an administrator
if ($_SESSION['isAdmin'] !== 1) {
    // If user are not an administrator, redirect to the index page
    header("Location: ../pages/index.php");
    exit();
}
?>
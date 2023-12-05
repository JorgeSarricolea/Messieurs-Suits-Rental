<?php
include '../database/connection.php';

session_start();

include '../includes/header.php';

// Testing
echo 'Hola, ' . $_SESSION['user_id'] . '!';
?>


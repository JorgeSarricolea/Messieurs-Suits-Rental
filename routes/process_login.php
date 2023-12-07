<?php
// Database connection file
include '../database/connection.php';

$error_message = '';
$success_login = '';

session_start();

// Check if data was sent from the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Search the user in the database by email
    $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Check if the user exists and the password is valid
    if ($user && password_verify($password, $user['password_hash'])) {
        // The login is successful
        $_SESSION['user_id'] = $user['user_ID'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['isAdmin'] = $user['isAdmin'];
        $success_login = true;
    } else {
        // The credentials are incorrect
        $error_message = 'Credenciales incorrectas';
    }
}
?>

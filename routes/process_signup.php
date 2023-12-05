<?php
// Database connection file
include '../database/connection.php';

$error_message = '';
$success_message = '';

// Check if data was submitted from the registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if data was submitted from the registration form
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already registered
    try {
      $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = :email');
      $stmt->execute(['email' => $email]);
    } catch (PDOException $e) {
        die('Error al ejecutar la consulta: ' . $e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        // Email is already registered, handle error as necessary
        $error_message = 'El correo electrónico ya está registrado.';
    } else {
        // Hashing the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $stmt = $pdo->prepare('INSERT INTO Users (name, lastname, email, password_hash) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $lastname, $email, $hashedPassword]);

        $success_message = '¡Cuenta creada con exito!';
    }
}
?>

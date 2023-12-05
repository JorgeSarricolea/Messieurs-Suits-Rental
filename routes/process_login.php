<?php
// Archivo de conexión a la base de datos
include '../database/connection.php';

// Verificar si se enviaron datos desde el formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el correo y la contraseña del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos por correo electrónico
    $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Verificar si el usuario existe y la contraseña es válida
    if ($user && password_verify($password, $user['password_hash'])) {
        // El login es exitoso
        echo 'Login exitoso';
    } else {
        // Las credenciales son incorrectas
        $error_message = 'Credenciales incorrectas.';
    }
}
?>

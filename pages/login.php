<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php
    // Process form logic
    include '../routes/process_login.php';
    ?>

    <form action="login.php" method="post">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Iniciar sesión</button>
    </form>

    <?php
    // Message handler
    if (!empty($error_message)) {
        // Show error message if it exists
        echo '<div id="error-message" style="color: red;">' . $error_message . '</div>';
        echo '<script>
                setTimeout(function () {
                    document.getElementById("error-message").style.display = "none";
                }, 3000);
            </script>';
    }

    if ($success_message === true) {
      // Redirect to index page
        header("Location: ./index.php");
        exit();
    }
    ?>
</body>
</html>

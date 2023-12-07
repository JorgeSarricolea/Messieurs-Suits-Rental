<?php
// Process form logic
include '../routes/process_signup.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS Files -->
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/login_signup.css">
    <title>Registro</title>
</head>
<body>
    <section id="signup-container">
        <h2>Registro</h2>
        <form id="signup-form" action="signup.php" method="post">
            <div class="input-container">
                <label for="name"><p>Nombre *</p></label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="input-container">
                <label for="lastname"><p>Apellido *</p></label>
                <input type="text" id="lastname" name="lastname" required>
            </div>

            <div class="input-container">
                <label for="email"><p>Correo electrónico *</p></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-container">
                <label for="password"><p>Contraseña *</p></label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Registrar</button>
            <p>¿Ya tienes una cuenta? <a href="./login.php">Inicia sesión</a></p>
        </form>

        <?php
        // Message handler
        if (!empty($error_message)) {
            // Show error message if it exists
            echo '<div id="error-message" style="color: red;">' . $error_message . '</div>';
            echo '<script>
                    setTimeout(function () {
                        document.getElementById("error-message").style.display = "none";
                    }, 2000);
                </script>';
        }

        if (!empty($success_message)) {
        // Show success message if it exists
        echo '<div id="success-message" style="color: green;">' . $success_message . '</div>';
        echo '<script>
                setTimeout(function () {
                    document.getElementById("success-message").style.display = "none";
                    window.location.href = "../pages/login.php";
                }, 2000);
                </script>';
    }
        ?>
    </section>
</body>
</html>

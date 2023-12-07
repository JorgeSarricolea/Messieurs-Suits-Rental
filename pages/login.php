<?php
// Process form logic
include '../routes/process_login.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS Files -->
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/login_signup.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Iniciar sesión</title>
</head>
<body>
    <section  id="login-container">
        <h2>Iniciar sesión</h2>
        <form id="login-form" action="login.php" method="post">
            <div class="input-container">
                <label for="email"><p>Correo electrónico *</p></label>
                <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
                <i class="fa-regular fa-envelope"></i>
            </div>

            <div class="input-container">
                <label for="password"><p>Contraseña *</p></label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <button type="submit">Iniciar sesión</button>
            <p>¿No tienes una cuenta? <a href="./signup.php">Registrate</a></p>
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

            if ($success_login === true) {
            // Redirect to index page
            if ($user['isAdmin'] === 1) {
                header("Location: ../admin/products.php");
                exit();
            } else {
                // Redirect to index page
                header("Location: ./index.php");
                exit();
                }
            }
            ?>
        </form>
    </section>
</body>
</html>

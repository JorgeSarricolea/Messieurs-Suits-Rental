<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>

    <?php
    // Process form logic
    include '../routes/process_signup.php';
    ?>

    <form action="signup.php" method="post">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>

        <label for="lastname">Apellido:</label>
        <input type="text" id="lastname" name="lastname" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Registrar</button>
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

    if (!empty($success_message)) {
      // Show success message if it exists
      echo '<div id="success-message" style="color: green;">' . $success_message . '</div>';
      echo '<script>
              setTimeout(function () {
                  document.getElementById("success-message").style.display = "none";
                  window.location.href = "../pages/login.php";
              }, 3000);
            </script>';
  }
    ?>
</body>
</html>

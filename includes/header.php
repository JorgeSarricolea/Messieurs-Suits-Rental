<nav>
    <a id="logo" href="../pages/index.php">
        <h1>messieurs</h1>
        <p>---- suits rental ----</p>
    </a>
    <ul>
        <li><a href="./index.php" <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'style="font-weight: bold;"'; ?>>Inicio</a></li>
        <li><a href="./catalogue.php" <?php if(basename($_SERVER['PHP_SELF']) == 'catalogue.php') echo 'style="font-weight: bold;"'; ?>>Catálogo</a></li>
        <li><a href="./quote.php" <?php if(basename($_SERVER['PHP_SELF']) == 'quote.php') echo 'style="font-weight: bold;"'; ?>>Cotizar</a></li>
        <li><a href="./contact.php" <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'style="font-weight: bold;"'; ?>>Contacto</a></li>

        <?php
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            // User is logged in
            echo '<li><a href="../pages/logout.php" id="logout-btn">Cerrar Sesión</a></li>';
        } else {
            // User is not logged in
            echo '<li><a href="./login.php" id="login-btn" '.(basename($_SERVER['PHP_SELF']) == 'login.php' ? 'style="font-weight: bold;"' : '').'>Iniciar Sesión</a></li>';
            echo '<li><a href="./signup.php" id="signup-btn"'.(basename($_SERVER['PHP_SELF']) == 'signup.php' ? 'style="font-weight: bold;"' : '').'>Registrarse</a></li>';
        }
        ?>
    </ul>
</nav>

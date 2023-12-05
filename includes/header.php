<nav>
    <ul>
    <li><a href="./index.php">Inicio</a></li>
    <li><a href="./catalogue.php">Catálogo</a></li>
    <li><a href="./quote.php">Cotizar</a></li>
    <li><a href="./contact.php">Contacto</a></li>
        <?php
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            // If the user is authenticated
            echo '<li><a href="../pages/logout.php">Cerrar Sesión</a></li>';
        } else {
            // If the user is not authenticated
            echo '<li><a href="./login.php">Iniciar Sesión</a></li>';
            echo '<li><a href="./signup.php">Registrarse</a></li>';
        }
        ?>
    </ul>
</nav>

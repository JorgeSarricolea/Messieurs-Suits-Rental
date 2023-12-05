<nav>
  <?php
  if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
      // If the user is authenticated, displays the logout link
      echo '<a href="./index.php">Cerrar Sesión</a>';
      session_destroy();
  }
  ?>
</nav>
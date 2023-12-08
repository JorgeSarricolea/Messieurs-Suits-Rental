<!-- Main CSS File -->
<link rel="stylesheet" href="../styles/side_menu.css">
<link rel="stylesheet" href="../styles/main.css">

<!-- Font Awesome src -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- To get the current page path -->
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="side-menu">
  <ul>
    <li class="<?php echo ($current_page === 'products.php') ? 'current' : ''; ?>">
    <i class="fa-solid fa-shirt"></i><a href="./products.php">Productos</a>
    </li>
    <li class="<?php echo ($current_page === 'add_product.php') ? 'current' : ''; ?>">
    <i class="fa-solid fa-circle-plus"></i><a href="./add_product.php">Nuevo producto</a>
    </li>
    <li class="<?php echo ($current_page === 'list_of_users.php') ? 'current' : ''; ?>">
    <i class="fa-solid fa-user"></i><a href="./list_of_users.php">Usuarios</a>
    </li>
    <li class="<?php echo ($current_page === 'list_of_quotes.php') ? 'current' : ''; ?>">
    <i class="fa-solid fa-bell"></i><a href="./list_of_quotes.php">Cotizaciones</a>
    </li>
    <li class="<?php echo ($current_page === 'logout.php') ? 'current' : ''; ?>">
    <i class="fa-solid fa-right-from-bracket"></i><a href="../pages/logout.php">Cerrar Sesión</a>
    </li>
  </ul>
</nav>



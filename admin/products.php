<?php
// Check if the user is an administrator
include './isAdmin.php';

// Side menu
include '../includes/side_menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
</head>
<body>
  <?php
  // Product options
  include '../includes/product_options.php';
  ?>
</body>
</html>
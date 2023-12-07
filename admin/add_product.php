<?php
// Check if the user is an administrator
include './isAdmin.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo producto</title>
</head>
<body>
<?php include '../includes/side_menu.php'?>
<nav>
    <ul>
      <li><a href="./suit_details.php">Trajes</a></li>
      <li><a href="./suit_jacket_details.php">Sacos</a></li>
      <li><a href="./suit_pant_details.php">Pantalones</a></li>
      <li><a href="./shirt_details.php">Camisas</a></li>
      <li><a href="./tie_details.php">Corbatas</a></li>
      <li><a href="./shoe_details.php">Zapatos</a></li>
    </ul>
</nav>

</body>
</html>
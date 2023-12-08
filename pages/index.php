<?php
// Start session
session_start();

// Header
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Main CSS Files -->
  <link rel="stylesheet" href="../styles/main.css">
  <link rel="stylesheet" href="../styles/header.css">
  <link rel="stylesheet" href="../styles/index.css">
  <title>Messieurs | Suits Rental</title>
</head>
<body>
  <!-- Main banner -->
  <section id="banner">
    <div class="banner-content">
      <h1><span> Viste el éxito con elegancia: </span>alquila o compra trajes que reflejen tu grandeza</h1>
      <a href="./catalogue.php">Catálogo</a>
    </div>
    <img src="../assets/img/banner.jpg" alt="">
  </section>

  <!-- Carousel -->
  <section class="carousel-container">
      <?php
      // Carousel
      include '../includes/carousel.php';
      ?>
  </section>
</body>
</html>
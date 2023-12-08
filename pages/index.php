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

  <!-- Video frame -->
  <section id="video">
    <h1>¡No dejes que la ropa te vista, tu viste la ropa!</h1>
    <iframe width="660" height="400" src="https://www.youtube.com/embed/-nTfrtzsup8?si=ySjXPTlzbvN99etg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
  </section>
</body>
</html>
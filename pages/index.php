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
  <link rel="stylesheet" href="../styles/index.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="crossorigin="anonymous" referrerpolicy="no-referrer" />
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

  <!-- Testimonials -->
  <section id="testimonials">
    <h1>Reseñas</h1>
    <div class="main-container">
      <div class="testimonial-container">
        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque in ipsum explicabo quibusdam impedit? Eos minus harum optio nobis fugiat.</p>
        <p class="user-name">- José Juan</p>
      </div>

      <div class="testimonial-container">
        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque in ipsum explicabo quibusdam impedit? Eos minus harum optio nobis fugiat.</p>
        <p class="user-name">- Samuel Dzip</p>
      </div>

      <div class="testimonial-container">
        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque in ipsum explicabo quibusdam impedit? Eos minus harum optio nobis fugiat.</p>
        <p class="user-name">- Alejandro Pérez</p>
      </div>
    </div>
  </section>

  <?php
  // Footer
  include '../includes/footer.php';
  ?>
</body>
</html>
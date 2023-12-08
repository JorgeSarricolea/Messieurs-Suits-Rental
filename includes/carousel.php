<?php
// Database connection file
include '../database/connection.php';

// Query to get the Suits table
$sql = "SELECT price, model, color, image_src FROM Suits";
$stmt = $pdo->query($sql);

// Get all the rows
$suits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Swiper CSS src -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

<!-- Swiper -->
<div class="swiper-container">
  <div class="swiper-wrapper">
    <?php foreach ($suits as $suit): ?>
    <div class="swiper-slide">
      <img src="<?php echo htmlspecialchars($suit['image_src']); ?>" alt="suit Image">
      <h3><?php echo htmlspecialchars($suit['model']); ?></h3>
      <p>Color: <?php echo htmlspecialchars(strtoupper($suit['color'])); ?></p>
      <p id="price-text">$<?php echo htmlspecialchars(number_format($suit['price'], 2)); ?> MXN</p>
    </div>
    <?php endforeach; ?>
  </div>
  <!-- Add Pagination -->
  <div class="swiper-pagination"></div>
  <!-- Add Arrows -->
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script src="../js/carousel.js"></script>
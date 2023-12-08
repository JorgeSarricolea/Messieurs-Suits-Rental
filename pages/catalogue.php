<?php
session_start();
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Main CSS Files -->
  <link rel="stylesheet" href="../styles/main.css">
  <link rel="stylesheet" href="../styles/catalogue.css">
  <title>Catálogo de Ropa</title>
</head>
<body>
  <!-- Searchbox -->
  <div id="searchbox">
    <input type="text" id="searchBox" placeholder="¿Qué estás buscando?" onkeyup="search(event)">
    <i class="fa-solid fa-magnifying-glass" onclick="search()"></i>
  </div>

  <section id="catalogue-container">
    <!-- Filters -->
    <div id="filters">
      <h2>Filtros</h2>
      <div class="filter-option" onclick="filterCatalogue('Suits')">Trajes</div>
      <div class="filter-option" onclick="filterCatalogue('SuitJackets')">Sacos</div>
      <div class="filter-option" onclick="filterCatalogue('SuitPants')">Pantalones</div>
      <div class="filter-option" onclick="filterCatalogue('Shirts')">Camisas</div>
      <div class="filter-option" onclick="filterCatalogue('Ties')">Corbatas</div>
      <div class="filter-option" onclick="filterCatalogue('Shoes')">Zapatos</div>
    </div>

    <!-- catalogueue element -->
    <div id="catalogue"></div>
  </section>

  <?php
  // Footer
  include '../includes/footer.php';
  ?>
  <script src="../js/catalogue.js"></script>
</body>
</html>

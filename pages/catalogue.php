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
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Catálogo de Ropa</title>
</head>
<body>
  <!-- Searchbox -->
  <div id="searchbox">
    <input type="text" id="searchBox" placeholder="¿Qué estás buscando?" onkeyup="search(event)">
    <i class="fa-solid fa-magnifying-glass" onclick="search()"></i>
  </div>

  <!-- Filters -->
  <div>
    <div class="filter-option" onclick="filterCatalogue('Suits')">Trajes</div>
    <div class="filter-option" onclick="filterCatalogue('SuitJackets')">Sacos</div>
    <div class="filter-option" onclick="filterCatalogue('SuitPants')">Pantalones</div>
    <div class="filter-option" onclick="filterCatalogue('Shirts')">Camisas</div>
    <div class="filter-option" onclick="filterCatalogue('Ties')">Corbatas</div>
    <div class="filter-option" onclick="filterCatalogue('Shoes')">Zapatos</div>
  </div>

  <!-- catalogueue element -->
  <div id="catalogue"></div>

  <script src="../js/catalogue.js"></script>
</body>
</html>

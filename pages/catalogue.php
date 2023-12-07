<?php
session_start();
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catálogo de Ropa</title>
</head>
<body>
  <div>
    <input type="text" id="searchBox" placeholder="¿Qué estás buscando?" onkeyup="search()">
    <button onclick="search()">Buscar</button>
  </div>

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

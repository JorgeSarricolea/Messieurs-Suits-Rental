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
    <div class="filter-option" onclick="filterCatalog('SuitJackets')">Sacos</div>
    <div class="filter-option" onclick="filterCatalog('SuitPants')">Pantalones</div>
    <div class="filter-option" onclick="filterCatalog('Shirts')">Camisas</div>
    <div class="filter-option" onclick="filterCatalog('Ties')">Corbatas</div>
    <div class="filter-option" onclick="filterCatalog('Shoes')">Zapatos</div>
  </div>

  <!-- Catalogue element -->
  <div id="catalog"></div>

  <script src="../js/catalogue.js"></script>
</body>
</html>

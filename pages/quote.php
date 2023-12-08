<?php
session_start();
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Main CSS Files -->
  <link rel="stylesheet" href="../styles/main.css">
  <link rel="stylesheet" href="../styles/quote.css">
  <title>Formulario de Cotización</title>
</head>
<body>
  <main id="main-container">
    <!-- Text container -->
    <section id="text-container">
      <h1>¿Necesitas algo a tu medida? <span>¡Cotiza ahora!</span></h1>
      <p>Es necesario llenar los campos obligatorios para poder procesar tu cotización.</p>
    </section>

    <!-- Quote form -->
    <form action="../routes/process_quote.php" method="post">
      <h2>Datos personales</h2>
      <div class="input-container">
        <label for="user_name">Nombre:</label>
        <input type="text" name="user_name" id="user_name" required placeholder="Nombre">
      </div>

      <div class="input-container">
        <label for="user_email">Correo electrónico:</label>
        <input type="email" name="user_email" id="user_email" required placeholder="Correo electrónico">
      </div>

      <h2>Tallas</h2>
      <div class="input-container">
        <label for="chest_size">Talla de pecho (cm):</label>
        <input type="number" name="chest_size" id="chest_size" required placeholder="Talla de pecho">
      </div>

      <div class="input-container">
        <label for="shoulder_size">Talla de hombros (cm):</label>
        <input type="number" name="shoulder_size" id="shoulder_size" required placeholder="Talla de hombros">
      </div>

      <div class="input-container">
        <label for="waist_size">Talla de cintura (cm):</label>
        <input type="number" name="waist_size" id="waist_size" required placeholder="Talla de cintura">
      </div>

      <div class="input-container">
        <label for="hip_size">Talla de cadera (cm):</label>
        <input type="number" name="hip_size" id="hip_size" required placeholder="Talla de cadera">
      </div>

      <div class="input-container">
        <label for="shoe_size">Talla de zapatos (cm):</label>
        <input type="number" name="shoe_size" id="shoe_size" required placeholder="Talla de zapatos">
      </div>

      <h2>Presupuesto</h2>
      <div class="input-container">
        <label for="budget">Presupuesto con el que cuentas para tu conjunto (MXN):</label>
        <input type="number" name="budget" id="budget" required placeholder="Presupuesto en MXN">
      </div>

      <input id="send-btn" type="submit" value="Enviar">
    </form>
  </main>

  <?php
  // Footer
  include '../includes/footer.php';
  ?>
</body>
</html>

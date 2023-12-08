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
  <link rel="stylesheet" href="../styles/contact.css">
  <title>Formulario de Contacto</title>
</head>
<body>
  <form name="contact-form" onsubmit="return validateForm()" action="mailto:jjorgesarricolea18@gmail.com" method="post">
    <h2>Datos personales</h2>
    <div class="input-container">
      <label for="name">Nombre:</label>
      <input type="text" name="name" id="name" placeholder="Nombre">
    </div>

    <div class="input-container">
      <label for="email">Correo electrónico:</label>
      <input type="email" name="email" id="email" placeholder="Correo electrónico">
    </div>

    <div class="input-container">
      <label for="subject">Asunto:</label>
      <input type="text" name="subject" id="subject" placeholder="Asunto del mensaje">
    </div>

    <div class="input-container">
      <label for="message">Mensaje:</label>
      <textarea name="message" id="message" placeholder="Mensaje"></textarea>
    </div>

    <!-- Success message -->
    <div id="success-message" style="display:none;">
      <p>¡Formulario enviado correctamente!</p>
    </div>

    <input id="send-btn" type="submit" value="Enviar">

  </form>

  <!-- Main JS File -->
  <script src="../js/contact.js"></script>
</body>
</html>

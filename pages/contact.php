<?php
session_start();
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
</head>
<body>

  <form name="contact-form" onsubmit="return validateForm()" action="mailto:jjorgesarricolea18@gmail.com" method="post">
    <h2>Datos personales</h2>
    Nombre: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Asunto: <input type="text" name="subject"><br>
    Mensaje: <textarea name="message"></textarea><br>

    <input type="submit" value="Enviar">
  </form>

  <div id="success-message" style="display:none;">
    <p>¡Formulario enviado correctamente!</p>
  </div>
<!-- Main JS File -->
<script src="../js/contact.js"></script>
</body>
</html>

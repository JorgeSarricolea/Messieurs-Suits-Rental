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
  <main id="main-container">
    <!-- Location -->
    <section id="location">
      <h1>¡Contáctanos!</h1>
      <p>Si tienes dudas de nuestro servicio o buscas algún traje en específico puedes contactarnos.</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.4915522902015!2d-89.66938402406733!3d21.013008988318063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5674891d01315f%3A0xcb8ba96b39a6031c!2sInstituto%20Tecnol%C3%B3gico%20de%20M%C3%A9rida%2C%20Campus%20Poniente!5e0!3m2!1ses-419!2smx!4v1702020433129!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <!-- Contact form -->
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
  </main>

  <!-- Main JS File -->
  <script src="../js/contact.js"></script>
</body>
</html>

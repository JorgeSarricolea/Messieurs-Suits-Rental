<?php
session_start();
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Cotización</title>
</head>
<body>
  <form action="../routes/process_quote.php" method="post">
      <h2>Datos personales</h2>
      Nombre: <input type="text" name="user_name" required><br>
      Email: <input type="email" name="user_email" required><br>

      <h2>Tallas</h2>
      Talla de pecho (cm): <input type="number" name="chest_size" required><br>
      Talla de hombros (cm): <input type="number" name="shoulder_size" required><br>
      Talla de cintura (cm): <input type="number" name="waist_size" required><br>
      Talla de cadera (cm): <input type="number" name="hip_size" required><br>
      Talla de zapatos (cm): <input type="number" name="shoe_size" required><br>

      <h2>Presupuesto</h2>
      Presupuesto con el que cuentas para tu conjunto (MXN): <input type="number" name="budget" required><br>

      <input type="submit" value="Enviar">
  </form>
</body>
</html>

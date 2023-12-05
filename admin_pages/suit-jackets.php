<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de SuitJackets</title>
</head>
<body>

<?php
  // Database connection file
  include '../database/connection.php';

  // Función para eliminar una chaqueta
  function eliminarChaqueta($conn, $jacketID) {
      $sql = "DELETE FROM SuitJackets WHERE jacket_ID = $jacketID";
      if ($conn->query($sql) === TRUE) {
          echo "Chaqueta eliminada correctamente";
      } else {
          echo "Error al eliminar la chaqueta: " . $conn->error;
      }
  }

  // Consulta SQL para obtener los datos de la tabla SuitJackets
  $sql = "SELECT * FROM SuitJackets";
  $result = $conn->query($sql);
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Chest Size</th>
            <th>Shoulder Size</th>
            <th>Price</th>
            <th>Model</th>
            <th>Color</th>
            <th>Image Source</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["jacket_ID"] . "</td>";
            echo "<td>" . $row["chest_size"] . "</td>";
            echo "<td>" . $row["shoulder_size"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["model"] . "</td>";
            echo "<td>" . $row["color"] . "</td>";
            echo "<td>" . $row["image_src"] . "</td>";
            echo "<td>";
            echo "<button onclick='editar(" . $row["jacket_ID"] . ")'>Editar</button>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='jacket_id' value='" . $row["jacket_ID"] . "' />";
            echo "<button type='submit' name='eliminar'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay datos disponibles</td></tr>";
    }

    // Eliminación de chaqueta si se ha enviado el formulario
    if (isset($_POST['eliminar'])) {
        $jacketID = $_POST['jacket_id'];
        eliminarChaqueta($conn, $jacketID);
    }

    // Cierra la conexión a la base de datos
    $conn->close();
    ?>

    </tbody>
</table>

<script>
    function editar(jacketID) {
        // Lógica para editar el elemento con el ID jacketID
        alert("Editar elemento con ID " + jacketID);
    }
</script>

</body>
</html>

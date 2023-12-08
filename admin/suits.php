<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trajes</title>
</head>
<body>

    <?php
    // Check if the user is an administrator
    include './isAdmin.php';

    // Database connection file
    include '../database/connection.php';

    // Side menu
    include '../includes/side_menu.php';

    // Function to remove a suit
    function deleteSuit($conn, $suitID) {
        $sql = "DELETE FROM Suits WHERE ID = $suitID";
        if ($conn->query($sql) === TRUE) {
            $deletion_message = "Traje eliminado correctamente";
            echo "<div class='deletion-message'>" . $deletion_message . "</div>";
            header("refresh:2;url=./suits.php");
        } else {
            $error_message = "Error al eliminar el traje";
            echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
        }
    }

    // Query to get data from Suits table
    $sql = "SELECT * FROM Suits";
    $result = $conn->query($sql);
    ?>

    <section id="main-table">
        <?php
        // Product options menu
        include '../includes/product_options.php';
        ?>
        <!-- Suits table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Color</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Talla de Pecho</th>
                    <th>Talla de Hombro</th>
                    <th>Talla de Cadera</th>
                    <th>Talla de Cintura</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["color"] . "</td>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["chest_size"] . "</td>";
                    echo "<td>" . $row["shoulder_size"] . "</td>";
                    echo "<td>" . $row["hip_size"] . "</td>";
                    echo "<td>" . $row["waist_size"] . "</td>";
                    echo "<td><img src='" . $row["image_src"] . "' alt='img'></td>";
                    echo "<td>";
                    // Edit link
                    echo "<a id='edit-btn' href='suit_details.php?id=" . $row["ID"] . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                    // Deleting element by form
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='delete' value='1' />";
                    echo "<input type='hidden' name='suit_id' value='" . $row["ID"] . "' />";
                    echo "<button id='delete-btn' type='button' onclick='confirmDeletion(event, " . $row["ID"] . ")'>";
                    echo "<i class='fa-solid fa-trash'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there is no data in the table
                echo "<tr><td colspan='9'>No hay trajes disponibles</td></tr>";
            }

            // Suit removal if form has been submitted
            if (isset($_POST['delete'])) {
                $suitID = $_POST['suit_id'];
                deleteSuit($conn, $suitID);
            }

            // Close the connection to the database
            $conn->close();
            ?>

            </tbody>
        </table>
    </section>

  <script>
      // Function to confirm the deletion of the element with the ID suitID
      function confirmDeletion(event, suitID) {
          let confirmation = confirm("¿Estás seguro de que quieres eliminar este traje?");
          if (confirmation) {
              // If the user clicks OK, find the closest form and submit it
              let form = event.target.closest('form');
              if (form) {
                  form.submit();
              }
          }
          // If the user clicks Cancel, prevent the form from being submitted
          event.preventDefault();
      }
  </script>
</body>
</html>

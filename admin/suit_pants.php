<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalones</title>
</head>
<body>

<?php
// Check if the user is an administrator
include './isAdmin.php';

// Database connection file
include '../database/connection.php';

// Side menu
include '../includes/side_menu.php';

// Function to remove a suit pant
function deleteSuitPant($conn, $pantID) {
    $sql = "DELETE FROM SuitPants WHERE pant_ID = $pantID";
    if ($conn->query($sql) === TRUE) {
        $deletion_message = "Pantalón eliminado correctamente";
        echo "<div class='deletion-message'>" . $deletion_message . "</div>";
        header("refresh:2;url=./suit_pants.php");
    } else {
        $error_message = "Error al eliminar el pantalón";
        echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
    }
}

// Query to get data from SuitPants table
$sql = "SELECT * FROM SuitPants";
$result = $conn->query($sql);
?>

    <section id="main-table">
        <?php
        // Product options menu
        include '../includes/product_options.php';
        ?>
        <!-- SuitPants table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Talla de cintura</th>
                    <th>Talla de cadera</th>
                    <th>Precio</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["pant_ID"] . "</td>";
                    echo "<td>" . $row["waist_size"] . "</td>";
                    echo "<td>" . $row["hip_size"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["color"] . "</td>";
                    echo "<td><img src='" . $row["image_src"] . "' alt='img'></td>";
                    echo "<td>";
                    // Edit link
                    echo "<a id='edit-btn' href='suit_pant_details.php?id=" . $row["pant_ID"] . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                    // Deleting element by form
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='delete' value='1' />";
                    echo "<input type='hidden' name='pant_id' value='" . $row["pant_ID"] . "' />";
                    echo "<button id='delete-btn' type='button' onclick='confirmDeletion(event, " . $row["pant_ID"] . ")'>";
                    echo "<i class='fa-solid fa-trash'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there is no data in the table
                echo "<tr><td colspan='8'>No hay datos disponibles</td></tr>";
            }

            // Suit pant removal if form has been submitted
            if (isset($_POST['delete'])) {
                $pantID = $_POST['pant_id'];
                deleteSuitPant($conn, $pantID);
            }

            // Close the connection to the database
            $conn->close();
            ?>

            </tbody>
        </table>
    </section>

    <script>
        // Function to confirm the deletion of the element with the ID pantID
        function confirmDeletion(event, pantID) {
            let confirmation = confirm("¿Estás seguro de que quieres eliminar este pantalón?");
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapatos</title>
</head>
<body>

<?php
    // Check if the user is an administrator
    include './isAdmin.php';

    // Database connection file
    include '../database/connection.php';

    // Side menu
    include '../includes/side_menu.php';

    // Function to remove a shoe
    function deleteShoe($conn, $shoeID) {
        $sql = "DELETE FROM Shoes WHERE shoe_ID = $shoeID";
        if ($conn->query($sql) === TRUE) {
            $deletion_message = "Zapato eliminado correctamente";
            echo "<div class='deletion-message'>" . $deletion_message . "</div>";
            echo "<script>setTimeout(function() { window.location.href = './shoes.php'; }, 2000);</script>";
        } else {
            $error_message = "Error al eliminar el zapato";
            echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
        }
    }

    // Query to get data from Shoes table
    $sql = "SELECT * FROM Shoes";
    $result = $conn->query($sql);
?>

    <section id="main-table">
        <?php
        // Product options menu
        include '../includes/product_options.php';
        ?>
        <!-- Shoes table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Talla</th>
                    <th>Precio</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Image</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["shoe_ID"] . "</td>";
                    echo "<td>" . $row["size"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["color"] . "</td>";
                    echo "<td><img src='" . $row["image_src"] . "' alt='img'></td>";
                    echo "<td>";
                    // Edit link
                    echo "<a id='edit-btn' href='shoe_details.php?id=" . $row["shoe_ID"] . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                    // Deleting element by form
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='delete' value='1' />";
                    echo "<input type='hidden' name='shoe_id' value='" . $row["shoe_ID"] . "' />";
                    echo "<button id='delete-btn' type='button' onclick='confirmDeletion(event, " . $row["shoe_ID"] . ")'>";
                    echo "<i class='fa-solid fa-trash'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there is no data in the table
                echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
            }

            // Shoe removal if form has been submitted
            if (isset($_POST['delete'])) {
                $shoeID = $_POST['shoe_id'];
                deleteShoe($conn, $shoeID);
            }

            // Close the connection to the database
            $conn->close();
            ?>

            </tbody>
        </table>
    </section>

    <script>
        // Function to confirm the deletion of the element with the ID shoeID
        function confirmDeletion(event, shoeID) {
            let confirmation = confirm("¿Estás seguro de que quieres eliminar estos zapatos?");
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

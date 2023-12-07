<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corbatas</title>
</head>
<body>

<?php
    // Check if the user is an administrator
    include './isAdmin.php';

    // Database connection file
    include '../database/connection.php';

    // Side menu
    include '../includes/side_menu.php';

    // Product options menu
    include '../includes/product_options.php';

    // Function to remove a tie
    function deleteTie($conn, $tieID) {
        $sql = "DELETE FROM Ties WHERE tie_ID = $tieID";
        if ($conn->query($sql) === TRUE) {
            $deletion_message = "Corbata eliminada correctamente";
            echo "<div class='deletion-message'>" . $deletion_message . "</div>";
            header("refresh:2;url=./ties.php");
        } else {
            $error_message = "Error al eliminar la corbata";
            echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
        }
    }

    // Query to get data from Ties table
    $sql = "SELECT * FROM Ties";
    $result = $conn->query($sql);
?>

    <!-- Ties table -->
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
                echo "<td>" . $row["tie_ID"] . "</td>";
                echo "<td>" . $row["size"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>" . $row["color"] . "</td>";
                echo "<td><img src='" . $row["image_src"] . "' alt='img' style='max-width: 80px; max-height: 80px;'></td>";
                echo "<td>";
                // Edit link
                echo "<a href='tie_details.php?id=" . $row["tie_ID"] . "'>edit</a>";
                // Deleting element by form
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='delete' value='1' />";
                echo "<input type='hidden' name='tie_id' value='" . $row["tie_ID"] . "' />";
                echo "<button type='button' onclick='confirmDeletion(event, " . $row["tie_ID"] . ")'>Eliminar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // If there is no data in the table
            echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
        }

        // Tie removal if form has been submitted
        if (isset($_POST['delete'])) {
            $tieID = $_POST['tie_id'];
            deleteTie($conn, $tieID);
        }

        // Close the connection to the database
        $conn->close();
        ?>

        </tbody>
    </table>

    <script>
        // Function to confirm the deletion of the element with the ID tieID
        function confirmDeletion(event, tieID) {
            let confirmation = confirm("¿Estás seguro de que quieres eliminar esta corbata?");
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

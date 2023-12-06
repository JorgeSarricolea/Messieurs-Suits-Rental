<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacos</title>
</head>
<body>

<?php
    // Database connection file
    include '../database/connection.php';

    // Product options menu
    include '../includes/product_options.php';

    // Function to remove a suit jacket
    function deleteSuitJacket($conn, $jacketID) {
        $sql = "DELETE FROM SuitJackets WHERE jacket_ID = $jacketID";
        if ($conn->query($sql) === TRUE) {
            echo "Saco eliminado correctamente";
        } else {
            echo "Error al eliminar el saco: " . $conn->error;
        }
    }

    // Query to get data from SuitJackets table
    $sql = "SELECT * FROM SuitJackets";
    $result = $conn->query($sql);
?>

    <!-- SuitJackets table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Talla de pecho</th>
                <th>Talla de hombros</th>
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
                echo "<td>" . $row["jacket_ID"] . "</td>";
                echo "<td>" . $row["chest_size"] . "</td>";
                echo "<td>" . $row["shoulder_size"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>" . $row["color"] . "</td>";
                echo "<td><img src='" . $row["image_src"] . "' alt='img' style='max-width: 80px; max-height: 80px;'></td>";
                echo "<td>";
                // Edit link
                echo "<a href='suit_jacket_details.php?id=" . $row["jacket_ID"] . "'>edit</a>";
                // Deleting element by form
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='delete' value='1' />";
                echo "<input type='hidden' name='jacket_id' value='" . $row["jacket_ID"] . "' />";
                echo "<button type='button' onclick='confirmDeletion(event, " . $row["jacket_ID"] . ")'>Eliminar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // If there is no data in the table
            echo "<tr><td colspan='8'>No hay datos disponibles</td></tr>";
        }

        // Suit jacket removal if form has been submitted
        if (isset($_POST['delete'])) {
            $jacketID = $_POST['jacket_id'];
            deleteSuitJacket($conn, $jacketID);
        }

        // Close the connection to the database
        $conn->close();
        ?>

        </tbody>
    </table>

    <script>
        // Function to confirm the deletion of the element with the ID jacketID
        function confirmDeletion(event, jacketID) {
        let confirmation = confirm("¿Estás seguro de que quieres eliminar este saco?");
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

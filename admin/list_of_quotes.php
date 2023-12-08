<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="../styles/admin_tables.css">
    <title>Cotizaciones</title>
</head>
<body>

    <?php
    // Check if the user is an administrator
    include './isAdmin.php';

    // Database connection file
    include '../database/connection.php';

    // Side menu
    include '../includes/side_menu.php';

    // Function to remove a quote
    function deleteQuote($conn, $quoteID) {
        $sql = "DELETE FROM Quotes WHERE quote_ID = $quoteID";
        if ($conn->query($sql) === TRUE) {
            $deletion_message = "Cotización eliminada correctamente";
            echo "<div class='deletion-message'>" . $deletion_message . "</div>";
            header("refresh:2;url=./list_of_quotes.php");
        } else {
            $error_message = "Error al eliminar la cotización";
            echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
        }
    }

    // Query to get data from Quotes table
    $sql = "SELECT * FROM Quotes";
    $result = $conn->query($sql);
    ?>

    <section id="main-table">
        <!-- Quotes table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Usuario</th>
                    <th>Correo Electrónico del Usuario</th>
                    <th>Presupuesto</th>
                    <th>Talla de Pecho</th>
                    <th>Talla de Hombro</th>
                    <th>Talla de Cintura</th>
                    <th>Talla de Cadera</th>
                    <th>Talla de Zapato</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["quote_ID"] . "</td>";
                    echo "<td>" . $row["user_name"] . "</td>";
                    echo "<td>" . $row["user_email"] . "</td>";
                    echo "<td>" . $row["budget"] . "</td>";
                    echo "<td>" . $row["chest_size"] . "</td>";
                    echo "<td>" . $row["shoulder_size"] . "</td>";
                    echo "<td>" . $row["waist_size"] . "</td>";
                    echo "<td>" . $row["hip_size"] . "</td>";
                    echo "<td>" . $row["shoe_size"] . "</td>";
                    echo "<td>";
                    // Edit link
                    echo "<a id='edit-btn' href='edit_quote.php?id=" . $row["quote_ID"] . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                    // Deleting element by form
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='delete' value='1' />";
                    echo "<input type='hidden' name='quote_id' value='" . $row["quote_ID"] . "' />";
                    echo "<button id='delete-btn' type='button' onclick='confirmDeletion(event, " . $row["quote_ID"] . ")'>";
                    echo "<i class='fa-solid fa-trash'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there is no data in the table
                echo "<tr><td colspan='10'>No hay cotizaciones disponibles</td></tr>";
            }

            // Quote removal if form has been submitted
            if (isset($_POST['delete'])) {
                $quoteID = $_POST['quote_id'];
                deleteQuote($conn, $quoteID);
            }

            // Close the connection to the database
            $conn->close();
            ?>

            </tbody>
        </table>
    </section>

    <script>
        // Function to confirm the deletion of the element with the ID quoteID
        function confirmDeletion(event, quoteID) {
            let confirmation = confirm("¿Estás seguro de que quieres eliminar esta cotización?");
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

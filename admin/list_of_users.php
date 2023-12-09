<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="../styles/admin_tables.css">
    <title>Usuarios</title>
</head>
<body>
    <?php
    // Check if the user is an administrator
    include './isAdmin.php';

    // Database connection file
    include '../database/connection.php';

    // Side menu
    include '../includes/side_menu.php';

    // Function to remove a user
    function deleteUser($conn, $userID) {
        $sql = "DELETE FROM Users WHERE user_ID = $userID";
        if ($conn->query($sql) === TRUE) {
            $deletion_message = "Usuario eliminado correctamente";
            echo "<div class='deletion-message'>" . $deletion_message . "</div>";
            echo "<script>setTimeout(function() { window.location.href = './list_of_users.php'; }, 2000);</script>";
        } else {
            $error_message = "Error al eliminar el usuario";
            echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
        }
    }

    // Query to get data from Users table
    $sql = "SELECT * FROM Users";
    $result = $conn->query($sql);
    ?>

    <section id="main-table">
        <!-- Users table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Es Administrador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_ID"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . ($row["isAdmin"] ? 'Sí' : 'No') . "</td>";
                    echo "<td>";
                    // Edit link
                    echo "<a id='edit-btn' href='edit_user.php?id=" . $row["user_ID"] . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                    // Deleting element by form
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='delete' value='1' />";
                    echo "<input type='hidden' name='user_id' value='" . $row["user_ID"] . "' />";
                    echo "<button id='delete-btn' type='button' onclick='confirmDeletion(event, " . $row["user_ID"] . ")'>";
                    echo "<i class='fa-solid fa-trash'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there is no data in the table
                echo "<tr><td colspan='6'>No hay usuarios disponibles</td></tr>";
            }

            // User removal if form has been submitted
            if (isset($_POST['delete'])) {
                $userID = $_POST['user_id'];
                deleteUser($conn, $userID);
            }

            // Close the connection to the database
            $conn->close();
            ?>

            </tbody>
        </table>
    </section>

    <script>
        // Function to confirm the deletion of the element with the ID userID
        function confirmDeletion(event, userID) {
            let confirmation = confirm("¿Estás seguro de que quieres eliminar este usuario?");
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

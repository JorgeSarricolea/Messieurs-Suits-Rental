<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
        header("refresh:2;url=./list_of_users.php");
    } else {
        $error_message = "Error al eliminar el usuario";
        echo "<div class='deletion-message'>" . $error_message . $conn->error . "</div>";
    }
}

// Query to get data from Users table
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
?>

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
            echo "<a href='edit_user.php?id=" . $row["user_ID"] . "'>edit</a>";
            // Deleting element by form
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='delete' value='1' />";
            echo "<input type='hidden' name='user_id' value='" . $row["user_ID"] . "' />";
            echo "<button type='button' onclick='confirmDeletion(event, " . $row["user_ID"] . ")'>Eliminar</button>";
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

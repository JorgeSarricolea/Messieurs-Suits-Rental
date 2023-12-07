<?php
// Check if the user is an administrator
include './isAdmin.php';

// Database connection file
include '../database/connection.php';

// Side menu
include '../includes/side_menu.php';

// Variables to pre-fill the form (default values)
$name = '';
$lastname = '';
$email = '';
$isAdmin = 0; // Default is not an admin

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $edit_user_id = $_GET['id'];

    // Make a query to obtain the details of the user to edit
    $sql = "SELECT * FROM Users WHERE user_ID = $edit_user_id";
    $result = $conn->query($sql);

    // Check if details were found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Use the details to pre-fill the form
        $name = $row['name'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $isAdmin = $row['isAdmin'];
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0; // Check if isAdmin checkbox is checked

    // Data cleaning
    $name = mysqli_real_escape_string($conn, $name);
    $lastname = mysqli_real_escape_string($conn, $lastname);
    $email = mysqli_real_escape_string($conn, $email);

    // Prepare the SQL query to update
    $update_id = $_POST['edit_user_id'];
    $sql = "UPDATE Users SET name = '$name', lastname = '$lastname', email = '$email', isAdmin = $isAdmin WHERE user_ID = $update_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $success_message = 'Usuario editado exitosamente';
        echo "<div class='success-message'>" . $success_message . "</div>";
        header("refresh:2;url=./list_of_users.php");
    } else {
        $error_message = 'Error al editar el usuario';
        echo "<div class='error-message'>" . $error_message . $conn->error . "</div>";
    }

    // Close the connection to the database
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <form action="./edit_user.php" method="post">
        <h2>Editar Usuario</h2>

        <!-- Hidden field for ID in case of editing -->
        <?php if (isset($edit_user_id)) { ?>
            <input type="hidden" name="edit_user_id" value="<?php echo $edit_user_id; ?>">
        <?php } ?>

        Nombre: <input type="text" name="name" value="<?php echo $name; ?>" required><br>
        Apellido: <input type="text" name="lastname" value="<?php echo $lastname; ?>" required><br>
        Correo electrónico: <input type="email" name="email" value="<?php echo $email; ?>" required><br>
        Es administrador: <input type="checkbox" name="isAdmin" <?php echo $isAdmin ? 'checked' : ''; ?>><br>

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>

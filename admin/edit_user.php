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
    $status = ""; // Initialize the state variable
    if ($conn->query($sql) === TRUE) {
        $success_message = "Usuario editado exitosamente";
        $status = "success"; // success status
        header("refresh:2;url=./list_of_users.php");
    } else {
        $error_message = "Error al editar el usuario";
        $status = "error"; // error status
    }

    // Close the connection to the database
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="../styles/RU_form.css">
    <title>Editar Usuario</title>
</head>
<body>
    <form id="RU-form" class="lonely-container" action="./edit_user.php" method="post">
        <?php
        // Show the status message
        if ($status === "success") {
            echo "<div class='success-message'>" . $success_message . "</div>";
        } elseif ($status === "error") {
            echo "<div class='error-message'>" . $error_message . $conn->error . "</div>";
        }
        ?>

        <h2>Editar Usuario</h2>

        <!-- Hidden field for ID in case of editing -->
        <?php if (isset($edit_user_id)) { ?>
            <input type="hidden" name="edit_user_id" value="<?php echo $edit_user_id; ?>">
        <?php } ?>

        <div class="input-container">
            <label for="name">Nombre:</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Ingrese su nombre" required><br>
        </div>

        <div class="input-container">
            <label for="lastname">Apellido:</label>
            <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Ingrese su apellido" required><br>
        </div>

        <div class="input-container">
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Ingrese su correo electrónico" required><br>
        </div>

        <div class="user-form" style="margin-bottom: 20px; justify-content: center; width: fit-content; display: flex; flex-direction: row; gap: 20px">
            <label for="isAdmin">Es administrador:</label>
            <input type="checkbox" name="isAdmin" <?php echo $isAdmin ? 'checked' : ''; ?>>
        </div>

        <input id="send-btn" type="submit" value="Guardar cambios">
    </form>
</body>
</html>

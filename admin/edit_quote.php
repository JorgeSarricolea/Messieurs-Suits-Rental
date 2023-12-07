<?php
// Check if the user is an administrator
include './isAdmin.php';

// Database connection file
include '../database/connection.php';

// Side menu
include '../includes/side_menu.php';

// Variables to pre-fill the form (default values)
$user_name = '';
$user_email = '';
$budget = '';
$chest_size = '';
$shoulder_size = '';
$waist_size = '';
$hip_size = '';
$shoe_size = '';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $edit_quote_id = $_GET['id'];

    // Make a query to obtain the details of the quote to edit
    $sql = "SELECT * FROM Quotes WHERE quote_ID = $edit_quote_id";
    $result = $conn->query($sql);

    // Check if details were found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Use the details to pre-fill the form
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $budget = $row['budget'];
        $chest_size = $row['chest_size'];
        $shoulder_size = $row['shoulder_size'];
        $waist_size = $row['waist_size'];
        $hip_size = $row['hip_size'];
        $shoe_size = $row['shoe_size'];
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $budget = $_POST['budget'];
    $chest_size = $_POST['chest_size'];
    $shoulder_size = $_POST['shoulder_size'];
    $waist_size = $_POST['waist_size'];
    $hip_size = $_POST['hip_size'];
    $shoe_size = $_POST['shoe_size'];

    // Data cleaning
    $user_name = mysqli_real_escape_string($conn, $user_name);
    $user_email = mysqli_real_escape_string($conn, $user_email);
    $budget = mysqli_real_escape_string($conn, $budget);
    $chest_size = mysqli_real_escape_string($conn, $chest_size);
    $shoulder_size = mysqli_real_escape_string($conn, $shoulder_size);
    $waist_size = mysqli_real_escape_string($conn, $waist_size);
    $hip_size = mysqli_real_escape_string($conn, $hip_size);
    $shoe_size = mysqli_real_escape_string($conn, $shoe_size);

    // Prepare the SQL query to update
    $update_id = $_POST['edit_quote_id'];
    $sql = "UPDATE Quotes SET user_name = '$user_name', user_email = '$user_email', budget = $budget, chest_size = $chest_size, shoulder_size = $shoulder_size, waist_size = $waist_size, hip_size = $hip_size, shoe_size = $shoe_size WHERE quote_ID = $update_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $success_message = 'Cotización editada exitosamente';
        echo "<div class='success-message'>" . $success_message . "</div>";
        header("refresh:2;url=./list_of_quotes.php");
    } else {
        $error_message = 'Error al editar la cotización';
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
    <title>Editar Cotización</title>
</head>
<body>
    <form action="./edit_quote.php" method="post">
        <h2>Editar Cotización</h2>

        <!-- Hidden field for ID in case of editing -->
        <?php if (isset($edit_quote_id)) { ?>
            <input type="hidden" name="edit_quote_id" value="<?php echo $edit_quote_id; ?>">
        <?php } ?>

        Nombre del Usuario: <input type="text" name="user_name" value="<?php echo $user_name; ?>" required><br>
        Correo Electrónico del Usuario: <input type="email" name="user_email" value="<?php echo $user_email; ?>" required><br>
        Presupuesto: <input type="text" name="budget" value="<?php echo $budget; ?>" required><br>
        Talla de Pecho (cm): <input type="number" name="chest_size" step="0.01" value="<?php echo $chest_size; ?>" required><br>
        Talla de Hombro (cm): <input type="number" name="shoulder_size" step="0.01" value="<?php echo $shoulder_size; ?>" required><br>
        Talla de Cintura (cm): <input type="number" name="waist_size" step="0.01" value="<?php echo $waist_size; ?>" required><br>
        Talla de Cadera (cm): <input type="number" name="hip_size" step="0.01" value="<?php echo $hip_size; ?>" required><br>
        Talla de Zapato: <input type="number" name="shoe_size" step="0.01" value="<?php echo $shoe_size; ?>" required><br>

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>

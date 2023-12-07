<?php
// Check if the user is an administrator
include './isAdmin.php';

// Database connection file
include '../database/connection.php';

// Side menu
include '../includes/side_menu.php';

// List of colors
include '../includes/color_options.php';

// List of models
include '../includes/models.php';

// Variables to pre-fill the form (default values)
$model = '';
$color = '';
$waist_size = '';
$hip_size = '';
$price = '';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $edit_pant_id = $_GET['id'];

    // Make a query to obtain the details of the pant to edit
    $sql = "SELECT * FROM SuitPants WHERE pant_ID = $edit_pant_id";
    $result = $conn->query($sql);

    // Check if details were found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Use the details to pre-fill the form
        $model = $row['model'];
        $color = $row['color'];
        $waist_size = $row['waist_size'];
        $hip_size = $row['hip_size'];
        $price = $row['price'];

        // Current image path
        $img_path = $row['image_src'];
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $model = $_POST['model'];
    $color = $_POST['color'];
    $waist_size = $_POST['waist_size'];
    $hip_size = $_POST['hip_size'];
    $price = $_POST['price'];

    // Data cleaning
    $model = mysqli_real_escape_string($conn, $model);
    $color = mysqli_real_escape_string($conn, $color);
    $waist_size = mysqli_real_escape_string($conn, $waist_size);
    $hip_size = mysqli_real_escape_string($conn, $hip_size);
    $price = mysqli_real_escape_string($conn, $price);

    // Check if it is an update or insert
    if (isset($_POST['edit_pant_id'])) {
        // Update: prepare the SQL query to update
        $update_id = $_POST['edit_pant_id'];

        // If a new image is uploaded, update the image path; otherwise, keep the existing one
        if ($_FILES['imagen']['size'] > 0) {
            $img_name = $_FILES['imagen']['name'];
            $img_tmp = $_FILES['imagen']['tmp_name'];

            // Check if a file was uploaded and if it is an image
            if (is_uploaded_file($img_tmp) && getimagesize($img_tmp)) {
                // Path where the new image will be saved
                $img_path = "../uploads/" . $img_name;

                // Move the new image to the specified folder
                move_uploaded_file($img_tmp, $img_path);
            }
        }

        $sql = "UPDATE SuitPants SET  model = '$model', color = '$color', waist_size = $waist_size, hip_size = $hip_size, price = $price";

        // Update the image path only if a new image was uploaded
        if (isset($img_path) && !empty($img_path)) {
            $sql .= ", image_src = '$img_path'";
        }

        $sql .= " WHERE pant_ID = $update_id";
    } else {
        // Insert: prepare the SQL query to insert
        // Ensure $img_path is set even if no new image is uploaded
        $img_path = isset($img_path) ? $img_path : '';

        // Check if a new image is provided in the case of an insertion
        if ($_FILES['imagen']['size'] > 0) {
            $img_name = $_FILES['imagen']['name'];
            $img_tmp = $_FILES['imagen']['tmp_name'];

            // Check if a file was uploaded and if it is an image
            if (is_uploaded_file($img_tmp) && getimagesize($img_tmp)) {
                // Path where the new image will be saved
                $img_path = "../uploads/" . $img_name;

                // Move the new image to the specified folder
                move_uploaded_file($img_tmp, $img_path);
            }
        }

        $sql = "INSERT INTO SuitPants (model, color, waist_size, hip_size, price, image_src) VALUES ('$model', '$color',$waist_size, $hip_size, $price, '$img_path')";
    }

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $success_message = isset($_POST['edit_pant_id']) ? 'Pantalón editado exitosamente' : 'Pantalón agregado exitosamente';
        echo "<div class='success-message'>" . $success_message . "</div>";
        header("refresh:2;url=./suit_pants.php");
    } else {
        $error_message = isset($_POST['edit_pant_id']) ? 'Error al editar' : 'Error al agregar';
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
    <title><?php echo isset($edit_pant_id) ? 'Editar' : 'Agregar'; ?> pantalón</title>
</head>
<body>
    <form action="./suit_pant_details.php" method="post" enctype="multipart/form-data">
        <h2><?php echo isset($edit_pant_id) ? 'Editar' : 'Agregar'; ?> pantalón</h2>

        <!-- Hidden field for ID in case of editing -->
        <?php if (isset($edit_pant_id)) { ?>
            <input type="hidden" name="edit_pant_id" value="<?php echo $edit_pant_id; ?>">
        <?php } ?>

        <!-- Model options -->
        Modelo:
        <select name="model" required>
            <option value="" disabled>Seleccione...</option>
            <?php
                foreach ($pants as $value => $text) {
                    echo "<option value='$value'" . ($model === $value ? ' selected' : '') . ">$text</option>";
                }
            ?>
        </select><br>

        <!-- Color options -->
        Color:
        <select name="color" required>
            <option value="" disabled>Seleccione...</option>
            <?php
                foreach ($color_options as $value => $text) {
                    echo "<option value='$value'" . ($color === $value ? ' selected' : '') . ">$text</option>";
                }
            ?>
        </select><br>

        Talla de cintura (cm): <input type="number" name="waist_size" value="<?php echo $waist_size; ?>" required><br>
        Talla de cadera (cm): <input type="number" name="hip_size" value="<?php echo $hip_size; ?>" required><br>
        Precio: <input type="text" name="price" value="<?php echo $price; ?>" required><br>

        <!-- Input to upload a image -->
        <section id="img-main-container">
            <label for="imagen"><?php echo isset($edit_pant_id) ? 'Editar' : 'Agregar'; ?> imagen</label>
            <input type="file" name="imagen" id="imagen_src" onchange="previewImage()" <?php echo !isset($edit_pant_id) ? 'required' : ''; ?>>

            <?php if (isset($img_path) && !empty($img_path)) { ?>
                <p>Imagen actual: <?php echo basename($img_path); ?></p>
                <img id="image-preview" src="<?php echo $img_path; ?>" alt="Vista previa de la imagen" style="max-width: 150px; max-height: 150px; margin-top: 10px;">
            <?php } else { ?>
                <img id="image-preview" src="../uploads/no_chosen_img.png" alt="Vista previa de la imagen predeterminada" style="max-width: 150px; max-height: 150px; margin-top: 10px;">
            <?php } ?>
        </section>

        <input type="submit" value="<?php echo isset($edit_pant_id) ? 'Guardar cambios' : 'Añadir'; ?>">
    </form>

    <script>
        function previewImage() {
            var fileInput = document.getElementById('imagen_src');
            var imagePreview = document.getElementById('image-preview');

            // Check if a file was selected
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Show image preview
                    imagePreview.src = e.target.result;
                };

                // Read file content as a data URL
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                // If no file is selected, show empty preview
                imagePreview.src = '';
            }
        }
    </script>
</body>
</html>

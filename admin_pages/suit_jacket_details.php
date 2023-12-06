<?php
    // Database connection file
    include '../database/connection.php';

    // Variables to pre-fill the form (default values)
    $model = '';
    $color = '';
    $chest_size = '';
    $shoulder_size = '';
    $price = '';

    // List of options for selectors
    $model_options = [
        'one-button' => 'One-Button',
        'two-button' => 'Two-Button',
        'four-button' => 'Four-Button',
        'single-breasted' => 'Single-Breasted',
        'double-breasted' => 'Double-Breasted',
        'smoking' => 'Smoking',
        'tailcoat' => 'Tailcoat',
        'smokblazering' => 'Blazer-Sport',
    ];

    $color_options = [
        'black' => 'Negro',
        'dark-blue' => 'Azul marino',
        'gray' => 'Gris',
        'dark-gray' => 'Gris oscuro',
        'white' => 'Blanco',
        'beige' => 'Beige',
    ];

    // Check if an ID is provided in the URL
    if (isset($_GET['id'])) {
        $edit_jacket_id = $_GET['id'];

        // Make a query to obtain the details of the bag to edit
        $sql = "SELECT * FROM SuitJackets WHERE jacket_ID = $edit_jacket_id";
        $result = $conn->query($sql);

        // Check if details were found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Use the details to pre-fill the form
            $model = $row['model'];
            $color = $row['color'];
            $chest_size = $row['chest_size'];
            $shoulder_size = $row['shoulder_size'];
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
        $chest_size = $_POST['chest_size'];
        $shoulder_size = $_POST['shoulder_size'];
        $price = $_POST['price'];

        // Image processing
        $img_name = $_FILES['imagen']['name'];
        $img_tmp = $_FILES['imagen']['tmp_name'];

        // Check if a file was uploaded and if it is an image
        if (is_uploaded_file($img_tmp) && getimagesize($img_tmp)) {
            // Path where the image will be saved
            $img_path = "../uploads/" . $img_name;

            // Move the image to the specified folder
            move_uploaded_file($img_tmp, $img_path);

            // Data cleaning
            $model = mysqli_real_escape_string($conn, $model);
            $color = mysqli_real_escape_string($conn, $color);
            $chest_size = mysqli_real_escape_string($conn, $chest_size);
            $shoulder_size = mysqli_real_escape_string($conn, $shoulder_size);
            $price = mysqli_real_escape_string($conn, $price);
            $img_path = mysqli_real_escape_string($conn, $img_path);

            // Check if it is an update or insert
            if (isset($_POST['edit_jacket_id'])) {
                // Update: prepare the SQL query to update
                $update_id = $_POST['edit_jacket_id'];
                $sql = "UPDATE SuitJackets SET model = '$model', color = '$color', chest_size = $chest_size, shoulder_size = $shoulder_size, price = $price, image_src = '$img_path' WHERE jacket_ID = $update_id";
            } else {
                // Insert: prepare the SQL query to insert
                $sql = "INSERT INTO SuitJackets (model, color, chest_size, shoulder_size, price, image_src) VALUES ('$model', '$color', $chest_size, $shoulder_size, $price, '$img_path')";
            }

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                echo isset($_POST['edit_jacket_id']) ? 'Saco editado exitosamente' : 'Saco agregado exitosamente';
            } else {
                echo "Error al agregar el saco: " . $conn->error;
            }

        } else {
            echo "Error: Subida de archivo no válida o no es una imagen.";
        }

        // Close the connection to the database
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($edit_jacket_id) ? 'Editar' : 'Agregar'; ?> saco</title>
</head>
<body>
    <form action="./suit_jacket_details.php" method="post" enctype="multipart/form-data">
        <h2><?php echo isset($edit_jacket_id) ? 'Editar' : 'Agregar'; ?> saco</h2>

        <!-- Hidden field for ID in case of editing -->
        <?php if (isset($edit_jacket_id)) { ?>
            <input type="hidden" name="edit_jacket_id" value="<?php echo $edit_jacket_id; ?>">
        <?php } ?>

        <!-- Model options -->
        Modelo:
        <select name="model" required>
            <option value="" disabled>Seleccione...</option>
            <?php
                foreach ($model_options as $valor => $texto) {
                    echo "<option value='$valor'" . ($model === $valor ? ' selected' : '') . ">$texto</option>";
                }
            ?>
        </select><br>

        <!-- Color options -->
        Color:
        <select name="color" required>
            <option value="" disabled>Seleccione...</option>
            <?php
                foreach ($color_options as $valor => $texto) {
                    echo "<option value='$valor'" . ($color === $valor ? ' selected' : '') . ">$texto</option>";
                }
            ?>
        </select><br>

        Talla de pecho (cm): <input type="number" name="chest_size" value="<?php echo $chest_size; ?>" required><br>
        Talla de hombro (cm): <input type="number" name="shoulder_size" value="<?php echo $shoulder_size; ?>" required><br>
        Precio: <input type="text" name="price" value="<?php echo $price; ?>" required><br>

        <div>
            <label for="imagen"><?php echo isset($edit_jacket_id) ? 'Editar' : 'Agregar'; ?> imagen</label>
            <input type="file" name="imagen" id="imagen_src" onchange="previewImage()" <?php echo isset($edit_jacket_id) ? '' : 'required'; ?>>
            <img id="image-preview" src="<?php echo isset($img_path) ? $img_path : '../uploads/no_chosen_img.png'; ?>" alt="Vista previa de la imagen" style="max-width: 150px; max-height: 150px; margin-top: 10px;">

        </div>

        <input type="submit" value="<?php echo isset($edit_jacket_id) ? 'Guardar cambios' : 'Añadir'; ?>">
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
                // If no file is selected, shows empty preview
                imagePreview.src = '';
            }
        }
    </script>
</body>
</html>

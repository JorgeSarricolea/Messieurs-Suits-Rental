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
$color = '';
$model = '';
$price = '';
$chest_size = '';
$shoulder_size = '';
$hip_size = '';
$waist_size = '';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $edit_suit_id = $_GET['id'];

    // Make a query to obtain the details of the suit to edit
    $sql = "SELECT * FROM Suits WHERE ID = $edit_suit_id";
    $result = $conn->query($sql);

    // Check if details were found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Use the details to pre-fill the form
        $color = $row['color'];
        $model = $row['model'];
        $price = $row['price'];
        $chest_size = $row['chest_size'];
        $shoulder_size = $row['shoulder_size'];
        $hip_size = $row['hip_size'];
        $waist_size = $row['waist_size'];

        // Current image path
        $img_path = $row['image_src'];
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $color = $_POST['color'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $chest_size = $_POST['chest_size'];
    $shoulder_size = $_POST['shoulder_size'];
    $hip_size = $_POST['hip_size'];
    $waist_size = $_POST['waist_size'];

    // Data cleaning
    $color = mysqli_real_escape_string($conn, $color);
    $model = mysqli_real_escape_string($conn, $model);
    $price = mysqli_real_escape_string($conn, $price);
    $chest_size = mysqli_real_escape_string($conn, $chest_size);
    $shoulder_size = mysqli_real_escape_string($conn, $shoulder_size);
    $hip_size = mysqli_real_escape_string($conn, $hip_size);
    $waist_size = mysqli_real_escape_string($conn, $waist_size);

    // Check if it is an update or insert
    if (isset($_POST['edit_suit_id'])) {
      // Update: prepare the SQL query to update
      $update_id = $_POST['edit_suit_id'];

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

      $sql = "UPDATE Suits SET  color = '$color', model = '$model', chest_size = $chest_size, shoulder_size = $shoulder_size, hip_size = $hip_size, waist_size = $waist_size, price = $price";

      // Update the image path only if a new image was uploaded
      if (isset($img_path) && !empty($img_path)) {
          $sql .= ", image_src = '$img_path'";
      }

      $sql .= " WHERE ID = $update_id";
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

      $sql = "INSERT INTO Suits (color, model, chest_size, shoulder_size, hip_size, waist_size, image_src, price) VALUES ('$color', '$model', $chest_size, $shoulder_size, $hip_size,  $waist_size, '$img_path',$price)";
  }

  // Execute the query
  $status = ""; // Initialize the state variable

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $success_message = isset($_POST['edit_suit_id']) ? 'Traje editado exitosamente' : 'Traje agregado exitosamente';
        $status = "success"; // success status
        header("refresh:2;url=./suits.php");
    } else {
        $error_message = isset($_POST['edit_suit_id']) ? 'Error al editar' : 'Error al agregar';
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
    <title><?php echo isset($edit_suit_id) ? 'Editar' : 'Agregar'; ?> traje</title>
</head>
<body>
<form id="RU-form" action="./suit_details.php" method="post" enctype="multipart/form-data">
    <?php
    // Show the status message
    if ($status === "success") {
        echo "<div class='success-message'>" . $success_message . "</div>";
    } elseif ($status === "error") {
        echo "<div class='error-message'>" . $error_message . $conn->error . "</div>";
    }
    ?>

    <!-- Hidden field for ID in case of editing -->
    <?php if (isset($edit_suit_id)) { ?>
        <input type="hidden" name="edit_suit_id" value="<?php echo $edit_suit_id; ?>">
    <?php } ?>

    <div class="form-container">
        <div id="form-data">
            <h2><?php echo isset($edit_suit_id) ? 'Editar' : 'Agregar'; ?> traje</h2>

            <!-- Model options -->
            <div class="select-container">
                <label for="model">Modelo:</label>
                <select name="model" id="model" required>
                    <option value="" disabled>Seleccione...</option>
                    <?php
                    foreach ($suits as $value => $text) {
                        echo "<option value='$value'" . ($model === $value ? ' selected' : '') . ">$text</option>";
                    }
                    ?>
                </select>

            <!-- Color options -->
                <label for="color">Color:</label>
                <select name="color" id="color" required>
                    <option value="" disabled>Seleccione...</option>
                    <?php
                    foreach ($color_options as $value => $text) {
                        echo "<option value='$value'" . ($color === $value ? ' selected' : '') . ">$text</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-container">
                <label for="price">Precio:</label>
                <input type="text" name="price" id="price" value="<?php echo $price; ?>" placeholder="Ingrese el precio" required>
            </div>

            <div class="input-container">
                <label for="chest_size">Talla de Pecho (cm):</label>
                <input type="number" name="chest_size" id="chest_size" value="<?php echo $chest_size; ?>" placeholder="Ingrese la talla de pecho" required>
            </div>

            <div class="input-container">
                <label for="shoulder_size">Talla de Hombro (cm):</label>
                <input type="number" name="shoulder_size" id="shoulder_size" value="<?php echo $shoulder_size; ?>" placeholder="Ingrese la talla de hombro" required>
            </div>

            <div class="input-container">
                <label for="hip_size">Talla de Cadera (cm):</label>
                <input type="number" name="hip_size" id="hip_size" value="<?php echo $hip_size; ?>" placeholder="Ingrese la talla de cadera" required>
            </div>

            <div class="input-container">
                <label for="waist_size">Talla de Cintura (cm):</label>
                <input type="number" name="waist_size" id="waist_size" value="<?php echo $waist_size; ?>" placeholder="Ingrese la talla de cintura" required>
            </div>
        </div>

        <!-- Input to upload an image -->
        <div id="form-image">
            <?php if (isset($img_path) && !empty($img_path)) { ?>
                <p>Imagen actual: <?php echo basename($img_path); ?></p>
                <img id="image-preview" src="<?php echo $img_path; ?>" alt="Vista previa de la imagen" style="max-width: 150px; max-height: 150px; margin-top: 10px;">
            <?php } else { ?>
                <img id="image-preview" src="../uploads/no_chosen_img.png" alt="Vista previa de la imagen predeterminada" style="max-width: 150px; max-height: 150px; margin-top: 10px;">
            <?php } ?>
            <label for="imagen"><?php echo isset($edit_suit_id) ? 'Editar' : 'Agregar'; ?> imagen</label>
            <input id="img-btn" type="file" name="imagen" id="imagen_src" onchange="previewImage()" <?php echo !isset($edit_suit_id) ? 'required' : ''; ?>>

            <input id="send-btn" type="submit" value="<?php echo isset($edit_suit_id) ? 'Guardar cambios' : 'Añadir'; ?>">
        </div>
    </div>



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

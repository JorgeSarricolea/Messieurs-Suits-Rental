<?php
    // Database connection file
    include '../database/connection.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Assign form data to PHP variables
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $chest_size = $_POST['chest_size'];
        $shoulder_size = $_POST['shoulder_size'];
        $waist_size = $_POST['waist_size'];
        $hip_size = $_POST['hip_size'];
        $shoe_size = $_POST['shoe_size'];
        $budget = $_POST['budget'];

        // Prepare the SQL query for insertion
        $stmt = $pdo->prepare('INSERT INTO Quotes (user_name, user_email, chest_size, shoulder_size, waist_size, hip_size, shoe_size, budget)
                               VALUES (:user_name, :user_email, :chest_size, :shoulder_size, :waist_size, :hip_size, :shoe_size, :budget)');

        // Assigns values ​​to query parameters
        $stmt->bindParam(':user_name', $name);
        $stmt->bindParam(':user_email', $email);
        $stmt->bindParam(':chest_size', $chest_size);
        $stmt->bindParam(':shoulder_size', $shoulder_size);
        $stmt->bindParam(':waist_size', $waist_size);
        $stmt->bindParam(':hip_size', $hip_size);
        $stmt->bindParam(':shoe_size', $shoe_size);
        $stmt->bindParam(':budget', $budget);

        // Run the query
        $stmt->execute();

        // Print a success message and redirect to index after 3 seconds
        echo '<div><h1>¡Cotización enviada correctamente!</h1></div>';
        header("refresh:2;url=../pages/index.php");
        exit();
    }
?>

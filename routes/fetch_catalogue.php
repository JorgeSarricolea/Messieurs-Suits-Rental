<?php
// Database connection file
include '../database/connection.php';

// Function to clean up input type and prevent SQL injections
function cleanType($type) {
    $validTypes = ['SuitJackets', 'SuitPants', 'Shirts', 'Ties', 'Shoes'];
    return in_array($type, $validTypes) ? $type : 'SuitJackets';
}

// Set content type as JSON
header('Content-Type: application/json');

// Get the type and search parameter of the request
$type = isset($_GET['type']) ? cleanType($_GET['type']) : 'SuitJackets';
$search = $_GET['search'] ?? '';

// Prevent SQL injection for type
$tableName = cleanType($type);

// Base SQL query
$sql = "SELECT * FROM {$tableName} WHERE model LIKE :search LIMIT 10";

// Prepare the declaration
$stmt = $pdo->prepare($sql);
$searchTerm = '%' . $search . '%';
$stmt->bindParam(':search', $searchTerm);

// Run and get results
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return results as JSON
echo json_encode($results);

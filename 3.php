<?php
// Connect to the database
$host = "localhost";
$user = "root";
$pass = "";
$db = "shp";
$conn = new PDO("mysql:host=localhost;dbname=smart_shopping", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the barcode from the URL parameter
$barcode = $_GET['barcode'] ?? '';

// No need to sanitize input when using prepared statements with PDO

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT name, price FROM products WHERE barcode = :barcode");
$stmt->bindParam(':barcode', $barcode);
$stmt->execute();

// Fetch the result as an associative array
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Encode the result as a JSON object
echo json_encode($result);
?>

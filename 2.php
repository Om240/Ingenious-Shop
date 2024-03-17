<?php
// Database connection setup
$port='3306';
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "smart_shopping"; // Your database name

// Create connection
$conn = new mysqli("localhost", "root", "", "smart_shopping");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO products (barcode, name, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $data['barcode'], $data['name'], $data['price']);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
}

// Delete data from the database
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Get the product ID from the request
    $id = $_GET['id'];

    // Prepare and bind the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Reset auto-increment counter for ID column if the table is empty
    $result = $conn->query("SELECT COUNT(*) AS count FROM products");
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $conn->query("ALTER TABLE products AUTO_INCREMENT = 1");
    }
}

// Close the database connection
$conn->close();
?>
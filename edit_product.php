<?php
// edit_product.php
$host = 'localhost';
$db   = 'smart_shopping';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=localhost;dbname=smart_shopping;charset=utf8mb4";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$barcode = $_GET['barcode'];
$name = $_GET['name'];
$price = $_GET['price'];

$sql = "UPDATE products SET name = ?, price = ? WHERE barcode = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$name, $price, $barcode]);
?>

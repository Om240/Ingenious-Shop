<?php
// get_products.php

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

$stmt = $pdo->query('SELECT barcode, name, price FROM products');
$data = [];
while ($row = $stmt->fetch())
{
    $data[] = $row;
}
echo json_encode($data);
?>

<?php
session_start();
include '../database/config.php';

header('Content-Type: application/json');

$price_min = isset($_GET['price-min']) ? $_GET['price-min'] : 0;
$price_max = isset($_GET['price-max']) ? $_GET['price-max'] : 3000;
$os = isset($_GET['os']) ? $_GET['os'] : '';
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';

$sql = "SELECT * FROM Item WHERE Price BETWEEN $price_min AND $price_max";

if ($os) {
    $sql .= " AND Phone_Type = '$os'";
}

if ($brand) {
    $sql .= " AND Phone_Brand = '$brand'";
}

$result = $conn->query($sql);

$items = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

$conn->close();
echo json_encode($items);
?>
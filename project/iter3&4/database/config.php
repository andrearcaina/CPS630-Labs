<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password
$dbname = "project1";
$port = 3307; // Custom port for XAMPP

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

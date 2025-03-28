<?php
// Inside session.php
session_start();
include '../database/config.php';
header('Content-Type: application/json');
$response = array();

print_r($_SESSION); // Check session contents for debugging

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION["email"])) {
        $response['email'] = $_SESSION['email'];
    } else {
        $response['error'] = "User is not signed in"; // Fixed typo here
    }
}

echo json_encode($response);  // Ensure response is valid JSON
?>
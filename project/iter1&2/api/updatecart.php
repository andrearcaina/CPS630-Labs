<?php
session_start();
include '../database/config.php';

header('Content-Type: application/json');


if (!isset($_SESSION['user_id'])) {
    echo json_encode(["Message" => "Must Sign in First"]);
    exit();
}
$user_id = $_SESSION['user_id'];
$itemId = $_GET['id'];
// Add more to cart
if ($_GET['add'] == "true") {
    $sql = "UPDATE shopping SET Quantity = Quantity+1 WHERE UserID = $user_id AND ItemID = $itemId;";
    $result = $conn->query($sql);
    $response = ["Message" => "Sucesfully Added to Shopping Cart"];
}
// Substract from the cart
else if ($_GET['add'] == "false") {
    // First check that there is at least one of the item in the shopping cart
    $sql = "SELECT Quantity FROM shopping WHERE UserID = $user_id AND ItemID = $itemId;";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        if ($row["Quantity"] > 1) {
            $sql = "UPDATE shopping SET Quantity = Quantity-1 WHERE UserID = $user_id AND ItemID = $itemId;";
            $result = $conn->query($sql);
            $response = ["Message" => "Sucesfully Removed from Shopping Cart"];
        }
        else if ($row["Quantity"] == 1){
            $sql = "DELETE FROM shopping WHERE UserID = $user_id AND ItemID = $itemId;";
            $result = $conn->query($sql);
            $response = ["Message" => "Sucesfully deleted item from shopping cart"];
        }
        else {
            $response = ["Message" => "Item not found in shopping cart"]; 
        }
    }
}

$conn->close();
echo json_encode($response);
?>
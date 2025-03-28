<?php
session_start();
include '../config/db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : null;

    if($item_id) {
        $user_id = $_SESSION["user_id"];

        // Check if the item is already in the shopping cart
        $sql = "SELECT * FROM shopping WHERE UserID=$user_id AND ItemID=$item_id";
        $result = mysqli_query($conn, $sql);

        //Item was not in shopping cart
        if($result->num_rows == 0) {
            $sql = "INSERT INTO shopping(UserID, ItemID, Quantity) VALUES ($user_id, $item_id, 1)";
            $result = mysqli_query($conn, $sql);
            if($result) {
                echo "Item: " . $item_id . " added to the cart!";
            }
            else {
                $_SESSION["error"] = "Something went wrong, please try again";
                echo "Something went wrong, please try again";
            }
        }
        // Item was already in the shopping cart
        else {
            $sql = "UPDATE shopping SET Quantity=(Quantity+1) WHERE UserID=$user_id AND ItemID=$item_id";
            $result = mysqli_query($conn, $sql);
            if($result) {
                echo "Item: " . $item_id . " added to the cart!";
            }
            else {
                $_SESSION["error"] = "Something went wrong, please try again";
                echo "Something went wrong, please try again";
            }
        }
    }
    else {
        echo "No item ID provided";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT item.ItemID, item.Item_name, item.Price, item.Image_URL, shopping.Quantity FROM shopping JOIN item on shopping.ItemID = item.ItemID JOIN users ON shopping.UserID = users.UserID WHERE users.UserID = $user_id;";
    $result = $conn->query($sql);

    $items = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    echo json_encode($items);
}
$conn->close();
?>
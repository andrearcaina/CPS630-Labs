<?php
session_start();
include '../config/db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $UserId = $_SESSION["user_id"];
  //First must get the items in the shopping cart
  $sql = "SELECT ItemID, Quantity FROM shopping WHERE UserID = $UserId";
  $result = $conn->query($sql);

  $stores = array();
  if ($result->num_rows > 0) {
    $sql = "SELECT s.name, s.id FROM stores s WHERE ";

    $conditions = []; // Array to store conditions
    while ($row = $result->fetch_assoc()) {
        // Correctly concatenate strings using .= and fix variable interpolation
        $conditions[] = "s.id IN (
            SELECT i.store_id FROM inventory i 
            WHERE i.item_id = " . $row['ItemID'] . " AND i.quantity >= " . $row['Quantity'] . "
        )";
    }
    // Join conditions with AND to ensure all conditions are met
    $sql .= implode(" AND ", $conditions) . ";";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $stores[] = $row;
      }
    }
    else {
      $stores[] = ["name" => "Out of Stock in All Stores", "id" => -1];
    }
  }
  //No items in the shopping cart
  else {
    $sql = "SELECT name, id FROM stores";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      $stores[] = $row;
    }
  }
  
  echo json_encode($stores);
  $conn->close();
}
?>
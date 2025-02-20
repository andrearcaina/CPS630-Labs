<?php
session_start(); # Starts the session or resumes an existing one
include '../database/config.php'; # contains database connection information

header('Content-Type: application/json'); #Content type of response is JSON


$UserId = $_SESSION['user_id']; //Gets the UserID from the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $StoreId = $_POST["Store"];
  if ($StoreId == -1) { // Means they are out of stock in all stores
    // Prevent submit
    $_SESSION['alert_message'] = 'The items you requested are out of stock in all stores, please modify your cart and try again.';
    header("Location: ../pages/cart.php");
    exit();
  }
  $dateIssued = date('Y-m-d'); //Date issues is always the current date

  $PaymentCode = rand(100000, 999999); //Generates a random 6 digit number for the payment code
  $TruckID = rand(1, 6); //Generates a random number between 1 and 6 for the truck ID

  //Arrival Date is 3 days later
  $date = new DateTime($dateIssued);
  $date->modify('+3 days');
  $ArrivalDate = $date->format('Y-m-d');

  //Gets the total price of the User
  $sql = "SELECT SUM(item.Price * shopping.Quantity) AS totalPrice 
          FROM shopping 
          JOIN item ON shopping.ItemID = item.ItemID 
          WHERE shopping.UserID = $UserId";

  $result = $conn->query($sql); //Executes the query
  $row = $result->fetch_assoc(); //Fetchs the first and only row
  $TotalPrice = $row['totalPrice']; //Assigns the total price to the value from the DB

  //Checks to see if the shopping cart is empty, if it is, then it will not place order
  $sql = "SELECT COUNT(*) AS itemCount FROM shopping WHERE UserID = $UserId";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $itemCount = $row['itemCount'];

  if ($itemCount == 0) {
    // Shopping cart is empty
    $_SESSION['alert_message'] = 'Your shopping cart is empty. Please add items to cart before placing an order';
    header("Location: ../pages/cart.php");
    exit();
  }


  $sql = "INSERT INTO orders (UserID, StoreID, DateIssued, ArrivalDate, TotalPrice, PaymentCode, TruckID) 
          VALUES ('$UserId', '$StoreId', '$dateIssued', '$ArrivalDate', '$TotalPrice', '$PaymentCode', '$TruckID')";

  $result = $conn->query($sql); //Executse query
  if ($result) {
    // Now we must decrease the inventory from the store 
    $sql = "SELECT ItemID, Quantity FROM shopping WHERE UserID = $UserId";
    $resultshop = $conn->query($sql);
    if ($resultshop) { // Check if the query was successful
      while ($row = $resultshop->fetch_assoc()) {
        $sql = "UPDATE inventory SET quantity = quantity - " . $row["Quantity"] . " WHERE item_id = " . $row["ItemID"] . " AND store_id = " . $StoreId . ";";
        $result = $conn->query($sql);
      }
    } else {
      // Handle error in SELECT query
      echo "Error in fetching shopping cart: " . $conn->error;
    }
    //Now that the order is sucessfully placed, we can remove items from shopping cart
    $sql = "DELETE FROM shopping WHERE UserID = $UserId";
    $deleteResult = $conn->query($sql);
    //Store alert message in session
    $_SESSION['alert_message'] = 'Order placed successfully! Thanks for shopping with us!';
  } else {
    $_SESSION['alert_message'] = 'Failed to place order. Please try again.';
  }
  $conn->close();

  //Redirect to original page
  header("Location: ../pages/cart.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $sql = "SELECT orders.*, stores.name 
    FROM stores 
    JOIN orders ON orders.StoreID = stores.id
    WHERE orders.UserID = $UserId
    ORDER BY orders.OrderID ASC
    ";
  $result = $conn->query($sql);

  $items = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }
  }

  echo json_encode($items);
  $conn->close();
}
?>
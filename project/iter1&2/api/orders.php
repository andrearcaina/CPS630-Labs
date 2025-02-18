<?php
session_start(); # Starts the session or resumes an existing one
include '../database/config.php'; # contains database connection information

header('Content-Type: application/json'); #Content type of response is JSON


$UserId = $_SESSION['user_id']; //Gets the UserID from the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  
  $dateIssued = date('Y-m-d'); //Date issues is always the current date

  $PaymentCode = rand(100000, 999999); //Generates a random 6 digit number for the payment code
  
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

  // Print out the total price
  echo "Total Price: $TotalPrice";

  $StoreId = 1; //Hard coded to 1 for now



  $sql = "INSERT INTO orders (UserID, StoreID, DateIssued, ArrivalDate, TotalPrice, PaymentCode) 
          VALUES ('$UserId', '$StoreId', '$dateIssued', '$ArrivalDate', '$TotalPrice', '$PaymentCode')";
  
  $result = $conn->query($sql); // Executes the query
  if ($result) {
      $response = ["success" => true, "message" => "Order placed successfully"];
  } else {
      $response = ["success" => false, "message" => "Error placing order: " . $conn->error];
  }
echo json_encode($response); // Send JSON response
}
?>
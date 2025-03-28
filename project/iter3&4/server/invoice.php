<?php
session_start();
include '../database/config.php';

header('Content-Type: application/json');

$UserId = $_SESSION['user_id'];



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
  
  $FName = $_SESSION['fname'];
  $LName = $_SESSION['lname'];
  $City = $_SESSION['city'];
  $Email = $_SESSION['email'];


  $dateIssued = date('Y-m-d');

  //Arrival Date is 3 days later
  $date = new DateTime($dateIssued);
  $date->modify('+3 days');
  $ArrivalDate = $date->format('Y-m-d');

  //Gets the total price of the User
  $sql = "SELECT SUM(item.Price * shopping.Quantity) AS totalPrice 
          FROM shopping 
          JOIN item ON shopping.ItemID = item.ItemID 
          WHERE shopping.UserID = $UserId";

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $TotalPrice = $row['totalPrice'];



  $sql = "SELECT SUM(Quantity) AS itemCount FROM shopping WHERE UserID = $UserId";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $itemCount = $row['itemCount'];


  $output = [$FName, $LName, $City, $Email, $TotalPrice, $dateIssued, $ArrivalDate, $itemCount];

  echo json_encode($output);
  $conn->close();
}
?>
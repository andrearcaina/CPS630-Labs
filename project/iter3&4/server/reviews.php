<?php
session_start();
include '../config/db.php';
include '../config/cors.php';

header('Content-Type: application/json');

$response = array('status' => 'error', 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Read JSON input sent from AngularJS
    $data = json_decode(file_get_contents("php://input"), true);
    
    $userid = $_SESSION['user_id'];
    $title = $data["title"];
    $review = $data['review'];
    $rating = $data['rating'];

    $sql = "INSERT INTO reviews (UserID, title, review, rating) VALUES ($userid, '$title', '$review', $rating);";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response['status'] = 'success';
        $respnse['message'] = "Sucesfully created review";
    } else {
        $response['message'] = "Something went wrong creating the review. Please try again.";
    }

    $conn->close();
    echo json_encode($response);
} else {

    $sql = "SELECT r.*, u.firstname, u.lastname FROM reviews r INNER JOIN users u ON r.UserID = u.UserID";

    $result = $conn->query($sql);

    $items = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }

    $conn->close();
    echo json_encode($items);
}

?>
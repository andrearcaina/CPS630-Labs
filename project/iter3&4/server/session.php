<?php
session_start();

include '../config/cors.php';

header('Content-Type: application/json');

error_log("Session ID: " . session_id());

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'loggedIn' => true,
        'user_id' => $_SESSION['user_id'],
        'fname' => $_SESSION['fname'],
        'lname' => $_SESSION['lname'],
        'email' => $_SESSION['email'],
        'city' => $_SESSION['city'],
        'isAdmin' => isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false
    ]);
} else {
    echo json_encode([
        'loggedIn' => false,
        'error' => 'User is not signed in'
    ]);
}
?>
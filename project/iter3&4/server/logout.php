<?php
session_start();

include '../config/cors.php';

header('Content-Type: application/json');

error_log("Session LOGOUT ID: " . session_id());


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['email'])) {
        session_unset();
        session_destroy();

        echo json_encode([
            'status' => 'success',
            'message' => 'Successfully logged out.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Not logged in.'
        ]);
    }
}
?>

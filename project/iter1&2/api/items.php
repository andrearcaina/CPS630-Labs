<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Default XAMPP password
    $dbname = "project1";
    $port = 3307; // Custom port for XAMPP

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
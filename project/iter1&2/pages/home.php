<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    A bunch of items here from DB
</body>

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

    $sql = "SELECT * FROM USERS";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["UserID"]. " - Name: " . $row["Name"]. " " . $row["TelNo"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    ?>

</html>
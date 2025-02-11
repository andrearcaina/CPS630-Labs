<?php
$servername = "localhost";
$username = "root";
$password = "testing"; // Default XAMPP password
$dbname = "testnew";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS StRec (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    year INT(4)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Student Records created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) as count FROM StRec";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

if ($row["count"] == 0) {
    $sql = "INSERT INTO StRec (firstName, lastName, year)
            VALUES 
                ('John', 'Smith', 1),
                ('Jack', 'Smick', 2),
                ('Jane', 'Snide', 3),
                ('Jake', 'Sneer', 4),
                ('Jace', 'Smeek', 5)";

    if (mysqli_query($conn, $sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$sql = "DELETE FROM StRec WHERE id=5";
if (mysqli_query($conn, $sql) === TRUE) {
    echo "\nRecord deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

$sql = "SELECT id, firstName, lastName, year FROM StRec";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Year</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"]. "</td>";
                echo "<td>" . $row["firstName"]. "</td>";
                echo "<td>" . $row["lastName"]. "</td>";
                echo "<td>" . $row["year"]. "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>0 results</td></tr>";
        }
        ?>
    </table>
</body>
</html>
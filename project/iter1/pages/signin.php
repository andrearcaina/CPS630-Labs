<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" href="./stylesSignUpIn.css">
</head>
<body>
    <header>
        <h1>Nav Bar Goes Here</h1>
    </header>
    <main>
        <h2>Sign In</h2>
        <center><form id="signinform" action="" method="post">
            <label for="email">Email:</label><br>
            <input type="text" id="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" required><br><br>
            <input type="submit" value="Submit">
        </form></center>
        <p>Don't have an account yet?</p><a href="./signup.php">Sign Up Here!</a>
    </main>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Default XAMPP password
    $dbname = "project1";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Execute Query to attempt to attempt to retrieve the user based on email and password provided
        $sql = "SELECT * FROM USERS WHERE email=$email AND password=$password";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();

        if ($row["count"] == 0) {
            echo "<p>Invalid Credentials. Try again.</p>";
        }
        else {
            echo "<p>Login successful! Welcome!</p>";
        }
    }
    ?>
</body>
</html>
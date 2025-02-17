<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/signin.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?><br>
        <h2>Sign In</h2>
        <center><form id="signinform" action="" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Submit">
        </form></center>
        <p>Don't have an account yet?</p><a href="./signup.php">Sign Up Here!</a>
    </main>
    <?php include '../components/footer.php'; ?>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Default XAMPP password
    $dbname = "project1";
    $port = 3307; // Custom port for XAMPP

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        echo "<p>Connectoin Died</p>";
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Execute Query to attempt to retrieve the user based on email and password provided
        $sql = "SELECT * FROM USERS WHERE Email='$email' AND Pass='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $_SESSION["error"] = "Invalid Email or Password. Please try again.";
            header("Location: signin.php");
            exit();
        } else {
            $row = $result->fetch_assoc();
            echo "<p>Login successful! Welcome!</p>";
            // Keep the user's info for this session
            $_SESSION["email"] = $email;
            $_SESSION["fname"] = $row["FirstName"];
            $_SESSION["lname"] = $row["LastName"];
            // Redirect the user to the Home Page
            header("Location: home.php");
            exit();
        }
    }

    $conn->close();
    ?>
</body>
</html>
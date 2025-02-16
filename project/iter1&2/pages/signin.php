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
        <h2>Sign In</h2>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?>
        <center><form id="signinform" action="" method="post">
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" required><br><br>
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
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Execute Query to attempt to attempt to retrieve the user based on email and password provided
        $sql = "SELECT * FROM USERS WHERE email='$email' AND pass='$password'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();

        if ($result->num_rows == 0) {
            $_SESSION["error"] = "Invalid Email or Password. Please try again.";
            header("Location: signin.php");
            exit();
        }
        else {
            echo "<p>Login successful! Welcome!</p>";
            // Keep the user's info for this session
            $_SESSION["email"] = $email;
            $_SESSION["fname"] = $row["FirstName"];
            $_SESSION["lname"]= $row["LastName"];
            // Redirect the user to the Home Page
            //header("Location: signup.php");
            exit();
        }
    }
    ?>
</body>
</html>
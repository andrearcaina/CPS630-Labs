<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/signup.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?><br>
        <h2>Sign Up</h2>
        <center><form id="signupform" action="" method="post">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname"required><br><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" name="lname" required><br><br>
            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" name="dob" required><br><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" required><br><br>
            <input type="submit" value="Submit">
        </form></center>
        <p>Already have an account?</p><a href="./signin.php">Sign In Here!</a>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../public/scripts/signup.js"></script>
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
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $dob = $_POST["dob"];
        $email = $_POST["email"];
        $password = $_POST["password"];


        // Execute Query to attempt to attempt to retrieve the user based on email to see if an account with that email already exists
        $sql = "SELECT * FROM USERS WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO USERS(FirstName, LastName, Email, DOB, Pass) Values('$fname','$lname','$email','$dob','$password')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $_SESSION["error"] = "Succesfully Created Account, Please Log in with your credentials now.";
                header("Location: signin.php");
                exit();
            }
            else {
                $_SESSION["error"] = "Something went wrong, please try again.";
                header("Location: signup.php");
                exit();
            }
        }
        else {
            $_SESSION["error"] = "There already exists an account with that email. Please Sign In or try again with a different email";
            header("Location: signup.php");
            exit();
        }
    }
    ?>
</body>
</html>
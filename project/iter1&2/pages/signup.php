<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/scripts/auth.js"></script>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?><br>
        <h2>Sign Up</h2>
        <center><form id="signupform" action="../api/auth.php" method="post">
            <input type="hidden" name="signup" value="1">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname"required><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" name="lname" required><br>
            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" name="dob" required><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" required><br>
            <label for="telno">Telephone Number:</label><br>
            <input type="text" id="telno" name="telno" required><br>
            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address" required><br>
            <label for="city">City:</label><br>
            <input type="text" id="city" name="city" required><br>
            <label for="postalcode">Postal Code:</label><br>
            <input type="text" id="postalcode" name="postalcode" required><br>
            <input type="submit" value="Submit">
        </form></center>
        <p>Already have an account?</p><a href="./signin.php">Sign In Here!</a>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../public/scripts/signup.js"></script>
</body>
</html>
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
    <h2 style="font-family: Playwrite IT Moderna, serif; font-weight: 800; font-style: normal; font-size: 45px; margin-bottom: 0px;">Sign Up</h2>
    <main style="padding-top: 0px;">
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?><br>
        <center><form id="signupform" action="../api/auth.php" method="post">
            <input type="hidden" name="signup" value="1">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname"required>
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" required>
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required>
            <label for="telno">Telephone Number</label>
            <input type="text" id="telno" name="telno" required>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
            <label for="city">City</label>
            <input type="text" id="city" name="city" required>
            <label for="postalcode">Postal Code</label>
            <input type="text" id="postalcode" name="postalcode" required>
            <input type="submit" value="Submit">
        </form></center>
        <p>Already have an account?</p><a href="./signin.php">Sign In Here!</a>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../public/scripts/signup.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="../public/styles/general.css">
    <link rel="stylesheet" href="../public/styles/signup.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <h2>Sign Up</h2>
        <center><form id="signupform">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" required><br><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" required><br><br>
            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" required><br><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" required><br><br>
            <input type="submit" value="Submit">
        </form></center>
        <p>Already have an account?</p><a href="./signin.php">Sign In Here!</a>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../public/scripts/signup.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/signin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/scripts/auth.js"></script>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <h2 style="font-family: Playwrite IT Moderna, serif; font-weight: 800; font-style: normal; font-size: 45px; margin-bottom: 0px;">Sign In</h2>
    <main>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?><br>
         <center><form id="signinform" action="../api/auth.php" method="post">
            <input type="hidden" name="signin" value="1">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Submit">
        </form></center>
        <p>Don't have an account yet?</p>
        <p id="account-text"><a href="./signup.php">Sign Up Here!</a></p>
    </main>
    <?php include '../components/footer.php'; ?>
</body>
</html>
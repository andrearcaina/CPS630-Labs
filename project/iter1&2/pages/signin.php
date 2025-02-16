<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" href="../public/styles/general.css">
    <link rel="stylesheet" href="../public/styles/signin.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main>
        <h2>Sign In</h2>
        <center><form id="signinform">
            <label for="email">Email:</label><br>
            <input type="text" id="email" required><br><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" required><br><br>
            <input type="submit" value="Submit">
        </form></center>
        <p>Don't have an account yet?</p><a href="./signup.php">Sign Up Here!</a>
    </main>
    <?php include '../components/footer.php'; ?>
</body>
</html>
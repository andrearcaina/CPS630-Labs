<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/about.css">
    <title>Reviews</title>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <?php
        if (!isset($_SESSION['fname'])) {
            header('Location: signin.php');
            exit();
        }
    ?>

    <center>
        <h1>Welcome, <?php echo $_SESSION['fname']; ?>!</h1>
    </center>

    <?php include '../components/footer.php'; ?>
</body>
</html>


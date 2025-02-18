<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/about.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="../public/scripts/items.js"></script>
    <link rel="stylesheet" href="../public/styles/home.css">
    <title>Reviews</title>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <?php
        if (!isset($_SESSION['fname'])) {
            header('Location: signin.php');
            exit();
        }
        if (isset($_SESSION['email']) == 'loquito@admin.com') {
            header('Location: ../index.php');
            exit();
        }
    ?>

    <center>
        <h1>Welcome, <?php echo $_SESSION['fname']; ?>!</h1>
    </center>
    <center><main class="items-section">
        <h2>Shopping Cart</h2>
        <div class="card-grid" id="cartitem-list">
            <!-- Items will be populated here by JavaScript -->
        </div>
    </main></center>

    <?php include '../components/footer.php'; ?>
</body>
</html>


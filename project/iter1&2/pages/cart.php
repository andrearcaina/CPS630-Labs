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
    <script src="../public/scripts/orders.js"></script>
    <link rel="stylesheet" href="../public/styles/home.css">
    <link rel="stylesheet" href="../public/styles/cart.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+IT+Moderna:wght@100..400&display=swap" rel="stylesheet">
    <title>Shopping Cart</title>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <?php
        if (!isset($_SESSION['fname'])) {
            header('Location: signin.php');
            exit();
        }
        if (isset($_SESSION['email']) && $_SESSION['email'] == 'loquito@admin.com'){
            header('Location: ../index.php');
            exit();
        }

        //Displays order status message
        if (isset($_SESSION['alert_message'])) { 
            echo "<script>alert('{$_SESSION['alert_message']}')</script>";
            unset($_SESSION['alert_message']);
        }
    ?>




    <center><main class="items-section">
        <h2 style="font-family: Playwrite IT Moderna, serif; font-weight: 800; font-style: normal; font-size: 45px">Shopping Cart</h2>
        <h1>Welcome, <?php echo $_SESSION['fname']; ?>!</h1>
        <div class="card-grid" id="cartitem-list">
            <!-- Items will be populated here by JavaScript -->
        </div>
    </main></center>


    <div>

    <!-- Purchase Shopping Cart Form -->
    <div class="purchase">
        <h2>Hey There <?php echo $_SESSION['fname']; ?>! Would like to proceed to checkout?</h2>
        <h3>We have registered that you are from <?php echo $_SESSION['city']; ?></h3>

        <form id="orderform" action="../api/orders.php" method="POST">
        
            <label for="store">Select Store</label><br></br> <!-- Stores are hard coded for now -->
            <select name="Store" id="lang">
                <!-- Stores available will be populated by JavaScript -->
            </select> 
            <br></br>

            <h2>Credit Card Information</h2>
                <label for="cardNumber">Card Number</label><br>
                <input type="text" id="cardNumber" name="cardNumber" pattern="\d{16}"title="Please enter a valid 16-digit credit card number" placeholder="Please enter a valid 16-digit credit card number"required><br><br>

                <label for="expiryDate">Expiration Date</label><br>
                <input type="text" id="expiryDate" name="expiryDate" pattern="(0[1-9]|1[0-2])\/?([0-9]{2})" placeholder="MM/YY" title="Please enter a valid expiration date in MM/YY format" required><br><br>

                <label for="cvv">CVV</label><br>
                <input type="text" id="cvv" name="cvv" pattern="\d{3}" title="Please enter a valid 3-digit CVV" placeholder = "Please enter a valid 3-digit CVV" required><br><br>

                <input type="submit" value="Purchase">
        </form>
    </div>


    <h1>Purchase History</h1>
        <div class="purchase-grid" id="purchase-history">
            <!-- Purchase history will be populated here by JavaScript -->
        </div>

        
    </div>

    <?php include '../components/footer.php'; ?>
</body>


</html>


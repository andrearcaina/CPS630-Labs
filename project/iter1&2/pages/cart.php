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


    

    <h2>Hey There <?php echo $_SESSION['fname']; ?>! would like to proceed to checkout?</h2>
    <h3>We have detected that you are from Toronto</h3>

    <form id="orderform" action="../api/orders.php" method="POST">
        
        <label for="store">Select Store</label><br></br> <!-- Stores are hard coded for now -->
        <select name="Store" id="lang">
            <option value="Store1">Store1</option>
            <option value="Store2">Store2</option>
            <option value="Store3">Store3</option>
            <option value="Store4">Store4</option>
        </select> 
        <br></br>

        <h2>Credit Card Information</h2>
        <label for="cardNumber">Card Number</label><br>
        <input type="text" id="cardNumber" name="cardNumber" required><br><br>

        <label for="expiryDate">Expiration Date</label><br>
        <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required><br><br>

        <label for="cvv">CVV</label><br>
        <input type="text" id="cvv" name="cvv" required><br><br>

        <input type="submit" value="Purchase">
    </form>

    <script>
    document.getElementById('orderform').addEventListener('submit', async (event) => {
      event.preventDefault(); //Stop form submission
      const formData = new FormData(event.target); //Gather form data
      const response = await fetch(event.target.action, { //Send data to server
        method: 'POST',
        body: formData,
      });
      const result = await response.json(); 
      alert(result.status === 'success' ? 'Order submitted!' : 'Error: Try again.'); //Notify user
    });
  </script>



    <?php include '../components/footer.php'; ?>
</body>


</html>


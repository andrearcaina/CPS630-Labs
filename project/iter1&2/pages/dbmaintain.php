<?php
if (!isset($_SESSION['email']) || $_SESSION['email'] != 'loquito@admin.com') {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Maintain</title>
    <link rel="stylesheet" href="../public/styles/global.css">
    <link rel="stylesheet" href="../public/styles/dbmaintain.css">
</head>
<body>
    <div class="table-container">
        <?php if (isset($_SESSION["fname"])): ?>
            <h1>Hello, <?php echo $_SESSION["fname"]; ?>! Welcome to Database Maintain</h1>
        <?php endif; ?>

        <div class="db-form">
            <h2>Insert into Database</h2>
            <form id="insert-form">
                <select id="table" name="table" required>
                    <option value="">Select Table</option>
                    <option value="item">Item</option>
                    <option value="trip">Trip</option>
                    <option value="truck">Truck</option>
                    <option value="users">Users</option>
                    <option value="shopping">Shopping</option>
                    <option value="stores">Stores</option>
                    <option value="inventory">Inventory</option>
                </select>
                <div id="form-fields"></div>
                <button type="submit">Insert</button>
            </form>
        </div>

        <div class="table-div">
            <h2>Items</h2>
            <table id="item-table">
                <thead>
                    <tr>
                        <th>ItemID</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Made In</th>
                        <th>Department Code</th>
                        <th>Phone Type</th>
                        <th>Phone Brand</th>
                        <th>Image URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Items will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <h2>Trips</h2>
            <table id="trip-table">
                <thead>
                    <tr>
                        <th>Trip_Id</th>
                        <th>Source Code</th>
                        <th>Destination Code</th>
                        <th>Distance</th>
                        <th>Truck_Id</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Trips will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <h2>Trucks</h2>
            <table id="truck-table">
                <thead>
                    <tr>
                        <th>Truck_Id</th>
                        <th>Truck Code</th>
                        <th>Availability Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Trucks will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <h2>Users</h2>
            <table id="users-table">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Password</th>
                        <th>Telephone Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postal Code</th>
                        <th>Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Users will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <h2>Shopping</h2>
            <table id="shopping-table">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>ItemID</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Shopping will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <h2>Stores</h2>
            <table id="stores-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Stores will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="table-div">
            <h2>Inventory</h2>
            <table id="inventory-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ItemID</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Stores will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/scripts/crud.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="../public/scripts/items.js"></script>
    <link rel="stylesheet" href="../public/styles/home.css">
</head>
<body>
    <?php if (isset($_SESSION["fname"])): ?>
        <h2>Hello, <?php echo $_SESSION["fname"]; ?>!</h2>
    <?php endif; ?>
    <div class="container">
        <aside class="filter-section">
            <form id="filter-form">
                <h3>Filter</h3>
                <label for="price-range">Price:</label>
                <div id="price-range"></div>
                <input type="hidden" id="price-min" name="price-min" value="0">
                <input type="hidden" id="price-max" name="price-max" value="3000">
                <p>Price: $<span id="price-min-display">0</span> - $<span id="price-max-display">3000</span></p>
                
                <label for="os">Operating System:</label>
                <select id="os" name="os">
                    <option value="">Select OS</option>
                    <option value="android">Android</option>
                    <option value="ios">iOS</option>
                </select>
                
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <option value="">Select Brand</option>
                    <option value="apple">Apple</option>
                    <option value="samsung">Samsung</option>
                    <option value="google">Google</option>
                    <option value="oneplus">OnePlus</option>
                    <option value="sony">Sony</option>
                    <option value="huawei">Huawei</option>
                </select>
                
                <button type="submit">Filter</button>
            </form>
        </aside>
        <main class="items-section">
            <h2>Items</h2>
            <div class="card-grid" id="item-list">
                <!-- Items will be populated here by JavaScript -->
            </div>
        </main>
    </div>
    <script>
        $(function() {
            $("#price-range").slider({
                range: true,
                min: 0,
                max: 3000,
                values: [0, 3000],
                slide: function(event, ui) {
                    $("#price-min").val(ui.values[0]);
                    $("#price-max").val(ui.values[1]);
                    $("#price-min-display").text(ui.values[0]);
                    $("#price-max-display").text(ui.values[1]);
                }
            });
        });
    </script>
</body>
<<<<<<< HEAD
=======

<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Default XAMPP password
    $dbname = "project1";
    $port = 3307; // Custom port for XAMPP

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM USERS";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["UserID"]. " - Name: " . $row["FirstName"]. " " . $row["TelNo"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    ?>

>>>>>>> 62f2ddf (Changes to UI)
</html>
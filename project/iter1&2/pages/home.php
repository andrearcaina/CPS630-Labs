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
        <h2 style="font-family: Playwrite IT Moderna, serif; font-weight: 800; font-style: normal; font-size: 45px">Hello, <?php echo $_SESSION["fname"]; ?>!</h2>
        <center><div id="cart">
            Add Items to Shopping Cart Here
        </div></center>
    <?php endif; ?>
    <div class="container">
        <aside class="filter-section">
            <form id="filter-form">
                <h1>Filter</h1>
                <label for="price-range"><h3>Price</h3></label>
                <div id="price-range"></div>
                <input type="hidden" id="price-min" name="price-min" value="0">
                <input type="hidden" id="price-max" name="price-max" value="3000">
                <p>Price: $<span id="price-min-display">0</span> - $<span id="price-max-display">3000</span></p>
                
                <label for="os"><h3>Operating System</h3></label>
                <select id="os" name="os">
                    <option value="">All OS</option>
                    <option value="android">Android</option>
                    <option value="ios">iOS</option>
                </select>
                
                <label for="brand"><h3>Brand</h3></label>
                <select id="brand" name="brand">
                    <option value="">All Brands</option>
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
</html>
<?php
session_start();
?>
<header>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barriecito&display=swap" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+IT+Moderna:wght@100..400&display=swap" rel="stylesheet">
    
    <img src="../public/images/logoremovebg.png" alt="Logo" class="logo">
    <h1 style="font-family: Barriecito, serif;font-weight: 500;font-style: normal; font-size: 50px; margin: 0;">The Phony Seal</h1>
    <nav>
        <ul style= "text-decoration: none;">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pages/about.php">About</a></li>
            <li><a href="../pages/reviews.php">Reviews</a></li>
            <li><a href="../pages/services.php">Type of Service</a></li>
            <?php if (isset($_SESSION["email"])): ?>
                <?php if ($_SESSION['email'] != 'loquito@admin.com'): ?>
                    <li><a href="../pages/cart.php">Shopping Cart</a></li>
                <?php endif; ?>
                <li><a href="../api/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="../pages/signup.php">Sign Up</a></li>
                <li><a href="../pages/signin.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
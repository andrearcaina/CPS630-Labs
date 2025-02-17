<?php
session_start();
?>
<header>
    <img src="../public/images/logoremovebg.png" alt="Logo" class="logo">
    <h1>Loquito</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pages/about.php">About</a></li>
            <li><a href="../pages/reviews.php">Reviews</a></li>
            <li><a href="../pages/services.php">Type of Service</a></li>
            <?php if (isset($_SESSION["email"])): ?>
                <li><a href="../pages/cart.php">Shopping Cart</a></li>
                <li><a href="../api/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="../pages/signup.php">Sign Up</a></li>
                <li><a href="../pages/signin.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
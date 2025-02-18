<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="public/styles/global.css">
</head>
<body>
    <?php include 'components/header.php'; ?>
    <?php if (isset($_SESSION['email']) && $_SESSION['email'] == 'loquito@admin.com'): ?>
        <?php include 'pages/dbmaintain.php'; ?>
    <?php else: ?>
        <?php include 'pages/home.php'; ?>
    <?php endif; ?>
    <?php include 'components/footer.php'; ?>
</body>
</html>
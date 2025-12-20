<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/output.css">
    <title>Sugar Manga</title>
</head>

<body>
    <?php include "./component/navbar.php" ?>
    <?php if (isset($_SESSION['logout'])): ?>
        <p class="text-red-800 text-md font-light -mt-5"><?php echo $_SESSION['logout'] ?></p>
        <?php unset($_SESSION['logout']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['login'])): ?>
        <p class="text-red-800 text-md font-light -mt-5"><?php echo $_SESSION['login'] ?></p>
        <?php unset($_SESSION['login']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['delete'])): ?>
        <p class="text-red-800 text-md font-light -mt-5"><?php echo $_SESSION['delete'] ?></p>
        <?php unset($_SESSION['delete']); ?>
    <?php endif; ?>
    <?php include "./component/navbar_mobile.php" ?>
</body>

</html>
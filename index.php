<?php
session_start();
include "koneksi.php";
$stmt = $conn->prepare("SELECT username, password, name_file FROM user WHERE username=?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = mysqli_fetch_assoc($result);
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
    <div class="hidden md:block">
        <?php include "./component/navbar.php" ?>
    </div>
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
    <?php if (isset($_SESSION['pesan_edit'])): ?>
        <p class="text-red-800 text-md font-light -mt-5"><?php echo $_SESSION['pesan_edit'] ?></p>
        <?php unset($_SESSION['pesan_edit']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['pesan_edit_upload'])): ?>
        <p class="text-red-800 text-md font-light -mt-5"><?php echo $_SESSION['pesan_edit_upload'] ?></p>
        <?php unset($_SESSION['pesan_edit_upload']); ?>
    <?php endif; ?>
    <div class="md:hidden">
        <?php include "./component/navbar_mobile.php" ?>
    </div>
    <script type="text/javascript" src="./component/detailProfile.js"></script>
</body>

</html>
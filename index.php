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
    <title>WaifuChan</title>
</head>

<body class="bg-[url('https://cdn.nekosia.cat/images/cowgirl/68649ca1563f6b10cc958352-compressed.jpg')] bg-cover bg-center bg-fixed">
    <!-- navbar -->
    <div class="hidden md:block fixed top-0 w-full">
        <?php include "./component/navbar.php" ?>
    </div>
    <div class="md:hidden flex fixed top-0 justify-between w-full items-center gap-4 bg-white/40 backdrop-blur-md">
        <div class="flex items-center pl-4 py-3 gap-2">
            <?php include "./component/identitas.php" ?>
        </div>
        <div class="relative mr-4 w-[45%]">
            <input class="w-full outline-0 shadow-lg shadow-slate-800/60 p-2 rounded-md" name="search" type="text" placeholder="Search for waifu" autocomplete="off" />
            <span class="absolute right-0 pt-1 px-1 bg-white rounded-lg">
                <svg class="w-8 h-8 text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </span>
        </div>
    </div>

    <?php if (isset($_SESSION['logout'])): ?>
        <p class="text-red-800 text-lg font-light text-center mt-20"><?php echo $_SESSION['logout'] ?></p>
        <?php unset($_SESSION['logout']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['login'])): ?>
        <p class="text-red-800 text-lg font-light text-center mt-20"><?php echo $_SESSION['login'] ?></p>
        <?php unset($_SESSION['login']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['delete'])): ?>
        <p class="text-red-800 text-lg font-light text-center mt-20"><?php echo $_SESSION['delete'] ?></p>
        <?php unset($_SESSION['delete']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['pesan_edit'])): ?>
        <p class="text-red-800 text-lg font-light text-center mt-20"><?php echo $_SESSION['pesan_edit'] ?></p>
        <?php unset($_SESSION['pesan_edit']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['pesan_edit_upload'])): ?>
        <p class="text-red-800 text-lg font-light text-center mt-20"><?php echo $_SESSION['pesan_edit_upload'] ?></p>
        <?php unset($_SESSION['pesan_edit_upload']); ?>
    <?php endif; ?>

    <!-- tags waifu -->
    <?php include "./component/categories.php" ?>

    <!-- tampilan waifu -->
    <div id="neko" class="columns-1 md:columns-2 lg:columns-3 mt-4 mb-24 md:mb-8"></div>

    <!-- navbar mobile -->
    <div class="md:hidden">
        <?php include "./component/navbar_mobile.php" ?>
    </div>
    <script type="text/javascript" src="./component/detailProfile.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./restApi/nekosiaApi.js"></script>
</body>

</html>
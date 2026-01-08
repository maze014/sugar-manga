<?php
session_start();
$_SESSION['current'] = $_GET['category'] ?? 'null';
$_SESSION['path'] = basename($_SERVER['PHP_SELF']);
include "koneksi.php";
$stmt = $conn->prepare("SELECT username, password, name_file FROM user WHERE username=?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = mysqli_fetch_assoc($result);

// query data table from favorite
$stmt = $conn->prepare("SELECT id_image FROM favorite WHERE username=?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$idImg = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/output.css">
    <title>Favorite Page</title>
</head>

<body class="bg-[url('https://cdn.nekosia.cat/images/cowgirl/68649ca1563f6b10cc958352-compressed.jpg')] bg-cover bg-center bg-fixed">
    <!-- navbar -->
    <input type="hidden" value="<?php while ($row = $idImg->fetch_assoc()) {
                                    echo $row['id_image'] . ',';
                                } ?>" />
    <input id="searchIndex" type="hidden" value="<?= htmlspecialchars($_SESSION['current']) ?>">
    <div class="hidden md:block fixed top-0 w-full z-50">
        <?php include "./component/navbar.php" ?>
    </div>
    <div class="md:hidden z-50 flex fixed top-0 justify-between w-full items-center gap-4 bg-white/40 backdrop-blur-md">
        <div class="flex items-center pl-4 py-3 gap-2">
            <?php include "./component/identitas.php" ?>
        </div>
        <div class="relative mr-4 w-[45%]">
            <input id="keywordMobile" class="w-full outline-0 shadow-lg shadow-slate-800/60 p-2 rounded-md" name="search" type="text" placeholder="Search for waifu" autocomplete="off" />
            <span class="absolute right-0 pt-1 px-1 bg-white rounded-lg">
                <svg class="w-8 h-8 text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </span>
        </div>
    </div>


    <!-- Tampilan belum login jika menuju ke favorite -->
    <?php if (!isset($_SESSION['username'])): ?>
        <div class="container absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 w-[80%] md:w-1/2 p-4 bg-white/40 backdrop-blur-md rounded-xl">
            <div class="flex gap-2 items-center justify-evenly pb-4">
                <h1 class="text-center font-medium tracking-wider md:text-xl lg:text-2xl">Silahkan Login atau Register</h1>
                <a href="login.php">
                    <svg class="md:w-10 md:h-10 lg:w-12 lg:h-12 text-gray-800 hover:text-violet-700 transition" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                </a>
            </div>
            <div class="flex gap-2 justify-between">
                <a class="py-2 basis-1/2 transition bg-violet-700 text-center shadow-lg shadow-violet-700/60 rounded-full text-md text-white font-medium hover:shadow-violet-700 hover:bg-violet-500" href="login.php">Log In</a>
                <a class="py-2 basis-1/2 transition bg-violet-700 text-center shadow-lg shadow-violet-700/60 rounded-full text-md text-white font-medium hover:shadow-violet-700 hover:bg-violet-500" href="register.php">Register</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Tampilan jika sudah login dan tidak ada favorite -->
        <?php if ($idImg->num_rows > 0): ?>
            <!-- tags waifu -->
            <?php include "./component/categories.php" ?>
            <!-- tampilan waifu -->
            <div id="neko" class="container max-w-[90%] mx-auto lg:max-w-full columns-1 md:columns-2 lg:columns-3 mb-24 mt-4 md:mb-8"></div>
        <?php else: ?>
            <div class="container flex flex-col gap-y-4 absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 w-[80%] md:w-1/2 lg:w-[40%] p-4 bg-white/40 backdrop-blur-md rounded-xl">
                <h1 class="text-center font-medium tracking-wider md:text-xl lg:text-2xl">Anda belum memiliki Favorite Waifu</h1>
                <a class="py-2 transition bg-violet-700 text-center shadow-lg shadow-violet-700/60 rounded-full text-md text-white font-medium hover:shadow-violet-700 hover:bg-violet-500" href="index.php">Home</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- navbar mobile -->
    <div class="md:hidden">
        <?php include "./component/navbar_mobile.php" ?>
    </div>
    <script type="text/javascript" src="./component/favoriteProfile.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <?php if (isset($_SESSION['username'])): ?>
        <script type="text/javascript" src="./restApi/favoriteWaifu.js"></script>
    <?php endif; ?>
</body>

</html>
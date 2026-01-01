<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Page</title>
    <link rel="stylesheet" href="./src/output.css">
</head>

<body class="bg-cover bg-center bg-fixed">
    <input type="hidden" value="<?= htmlspecialchars($_GET['id']) ?>" />
    <div class="md:hidden flex justify-between w-full items-center gap-4 bg-white/40 backdrop-blur-md">
        <div class="flex items-center pl-4 py-3 gap-2">
            <?php include "./component/identitas.php" ?>
        </div>
    </div>

    <div class="bg-violet-700 shadow-lg ml-4 mt-4 shadow-violet-700/60 transition group hover:bg-white hover:shadow-slate-800/60 inline-block rounded-full px-4">
        <a href="index.php<?= htmlspecialchars($_SESSION['current'] === 'null' ? '' : '?category=' . $_SESSION['current']) ?>">
            <svg class="transition w-8 h-8 text-white group-hover:text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col mx-auto w-[90%] mt-4 gap-4">
        <img class="rounded-xl w-[70%] mx-auto" src="" alt="" />
        <div>
            <h1>Artist</h1>
            <p>Profile: </p>
            <p>Username: </p>
        </div>
        <div id="detailContent" class="flex flex-wrap gap-2"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./component/detail.js"></script>
</body>

</html>
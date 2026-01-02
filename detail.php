<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/output.css">
    <title>Detail Page</title>
</head>

<body class="bg-cover bg-center bg-fixed">
    <!-- identitas -->
    <input type="hidden" value="<?= htmlspecialchars($_GET['id']) ?>" />
    <div class="flex justify-between w-full items-center gap-4 bg-white/40 backdrop-blur-md">
        <div class="flex items-center pl-4 py-3 gap-2">
            <?php include "./component/identitas.php" ?>
        </div>
    </div>

    <!-- tombol kembali ke home page -->
    <div class="bg-violet-700 shadow-lg ml-4 mt-4 shadow-violet-700/60 transition group hover:bg-white hover:shadow-slate-800/60 inline-block rounded-full px-4">
        <a href="index.php<?= htmlspecialchars($_SESSION['current'] === 'null' ? '' : '?category=' . $_SESSION['current']) ?>">
            <svg class="transition w-8 h-8 text-white group-hover:text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
        </a>
    </div>

    <!-- detail waifu -->
    <div class="container md:flex-row flex flex-col md:items-start mx-auto w-[90%] mt-4 pb-24 gap-4">
        <img class="rounded-xl w-[90%] md:w-[40%] mx-auto shadow-lg shadow-slate-800/60" src="" alt="" />
        <div class="bg-white/40 md:w-[60%] backdrop-blur-md rounded-xl px-4 pt-2 pb-4 shadow-lg shadow-slate-800/60">
            <h1 class="text-2xl font-medium flex items-center gap-2 justify-center text-slate-800">Artist
                <span>
                    <svg class="w-8 h-8 mt-1 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                    </svg>
                </span>
            </h1>
            <p class="text-lg font-medium text-slate-800"></p>
            <p class="text-lg font-medium text-slate-800"></p>
            <p class="text-lg font-medium text-slate-800"></p>
            <p class="text-lg font-medium text-slate-800 pb-1"></p>
            <h2 class="text-2xl font-medium flex items-center gap-2 justify-center text-slate-800">Tags
                <span>
                    <svg class="w-8 h-8 mt-1 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                </span>
            </h2>
            <div class="relative md:mx-2">
                <div id="detailContent" class="flex items-center overflow-x-scroll text-nowrap scrollbar-none gap-2 px-1 scroll-smooth select-none py-4"></div>
            </div>
            <button class="flex select-none mx-auto items-center gap-2 text-lg text-white font-medium bg-violet-700 shadow-md shadow-violet-700/60 px-5 rounded-xl py-2 tracking-wider">Favorite
                <svg class="w-8 h-8 text-rose-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                </svg>
            </button>
            <p id="copyright" class="text-sm text-center font-light text-slate-800"></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./component/detail.js" defer></script>
</body>

</html>
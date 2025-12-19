<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/output.css">
    <title>Profile Page</title>
</head>

<body>
    <!-- identitas -->
    <div class="flex w-full items-center pl-4 py-3 gap-2">
        <?php include "./component/identitas.php" ?>
    </div>

    <!-- Logo -->
    <div class="w-full min-h-[85vh] flex flex-col justify-center items-center gap-10">
        <?php if (isset($_SESSION['username'])): ?>
            <span class="shadow-xl shadow-slate-800/60 rounded-full">
                <svg class="w-[200px] h-[200px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                </svg>
            </span>
        <?php else: ?>
            <span class="shadow-xl shadow-slate-800/60 rounded-2xl">
                <svg width="250" height="250" viewBox="0 0 320 320" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="titleGrad" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#f472b6" />
                            <stop offset="100%" stop-color="#38bdf8" />
                        </linearGradient>
                    </defs>

                    <!-- Background -->
                    <rect width="320" height="320" rx="20" fill="#0f172a" />

                    <!-- Book -->
                    <rect x="70" y="60" width="180" height="110" rx="10" fill="#f8fafc" />
                    <line x1="160" y1="60" x2="160" y2="170" stroke="#94a3b8" stroke-width="2" />

                    <!-- Manga lines -->
                    <line x1="85" y1="80" x2="145" y2="80" stroke="#475569" stroke-width="2" />
                    <line x1="85" y1="95" x2="145" y2="95" stroke="#475569" stroke-width="2" />
                    <line x1="175" y1="80" x2="235" y2="80" stroke="#475569" stroke-width="2" />
                    <line x1="175" y1="95" x2="235" y2="95" stroke="#475569" stroke-width="2" />

                    <!-- Hands -->
                    <ellipse cx="60" cy="130" rx="20" ry="28" fill="#facc15" />
                    <ellipse cx="260" cy="130" rx="20" ry="28" fill="#facc15" />

                    <!-- Text -->
                    <text x="160" y="220" text-anchor="middle"
                        font-size="36" font-weight="800"
                        fill="url(#titleGrad)"
                        font-family="Arial, Helvetica, sans-serif">
                        SUGAR
                    </text>

                    <text x="160" y="260" text-anchor="middle"
                        font-size="32" font-weight="700"
                        fill="#38bdf8"
                        font-family="Arial, Helvetica, sans-serif">
                        MANGA
                    </text>
                </svg>
            </span>
        <?php endif; ?>
        <div class="w-2/3 flex flex-col gap-2">
            <div class="flex justify-between">
                <a href="<?php echo isset($_SESSION['username']) ? 'logout.php' : 'login.php' ?>" class="bg-violet-700 px-6 py-1 shadow-lg shadow-violet-800/60 rounded-full font-medium text-lg text-white"><?php echo isset($_SESSION['username']) ? 'Log Out' : 'Log In' ?></a>
                <a href="register.php" class="bg-violet-700 px-6 py-1 shadow-lg shadow-violet-800/60 rounded-full font-medium text-lg text-white">Register</a>
            </div>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="edit.php" class="bg-amber-500 flex justify-center w-full py-1 shadow-lg shadow-amber-500/60 rounded-full font-medium text-lg text-white">Edit Profile</a>
                <a href="delete.php" class="bg-rose-700 flex justify-center px-6 py-1 shadow-lg shadow-rose-800/60 rounded-full font-medium text-lg text-white">Delete Account</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- navbar mobile -->
    <?php include "./component/navbar_mobile.php" ?>
</body>

</html>
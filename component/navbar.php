<header class="bg-violet-600 flex py-4">
    <!-- logo -->
    <div class="w-[25%] flex items-center gap-1 justify-start pl-3">
        <span class="transition duration-700 hover:scale-110 hover:transition hover:duration-700">
            <a href="index.php">
                <svg class="w-10 h-10 lg:w-12 lg:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd" />
                </svg>
            </a>
        </span>
        <span class="transition duration-700 hover:scale-110 hover:transition hover:duration-700 font-medium text-white text-xl lg:text-2xl mb-1"><a href="index.php">Sugar manga</a></span>
    </div>
    <!-- search -->
    <div class="w-[35%] relative">
        <input class="w-full outline-0 shadow-lg shadow-slate-800/60 p-2 rounded-md" name="search" type="text" placeholder="Search for manga" autocomplete="off" />
        <span class="absolute right-0 pt-1 px-1 bg-white rounded-lg">
            <svg class="w-8 h-8 text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
            </svg>
        </span>
    </div>
    <!-- navbar -->
    <nav class="w-[35%] flex pb-1 px-1 relative">
        <ul class="flex text-white font-light items-center w-full justify-evenly lg:text-xl">
            <li class="transition duration-700 hover:scale-110 hover:transition hover:duration-700"><a href="index.php">Home</a></li>
            <li class="transition duration-700 hover:scale-110 hover:transition hover:duration-700"><a href="">Explore</a></li>
            <li class="transition duration-700 hover:scale-110 hover:transition hover:duration-700"><a href="">My List</a></li>
            <li class="transition duration-700 hover:scale-110 hover:transition hover:duration-700"><a href="">My Download</a></li>
        </ul>
    </nav>
    <!-- profile -->
    <?php if (!isset($_SESSION['username'])): ?>
        <div class="relative flex items-center justify-evenly pb-1 pr-3 select-none lg:text-xl">
            <!-- kalo belum login -->
            <a class="text-white font-light transition duration-700 hover:scale-110 hover:transition hover:duration-700" href="login.php">Login</a>
            <!-- tanda panah -->
            <span id="detailProfile" class="cursor-pointer rounded-full transition duration-300">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z" clip-rule="evenodd" />
                </svg>
            </span>
            <a class="text-white absolute hidden right-1/2 translate-x-1/4 pl-3 -bottom-4 font-light transition duration-700 hover:scale-110 hover:transition hover:duration-700" href="register.php">Register</a>
        </div>
    <?php else: ?>
        <a class="mr-3 border rounded-full transition duration-700 hover:scale-110 hover:transition hover:duration-700" href="profile.php">
            <?php if (isset($user['name_file'])): ?>
                <div class="rounded-full overflow-hidden w-12 h-12">
                    <img class="w-full h-full object-cover object-center" src="./uploads/<?php echo htmlspecialchars($user['username'] . '.' . strtolower(pathinfo($user['name_file'], PATHINFO_EXTENSION))) ?>" alt="foto profile user" />
                </div>
            <?php else: ?>
                <svg class="w-12 h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                </svg>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</header>
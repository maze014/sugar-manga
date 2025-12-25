<?php
session_start();
include "koneksi.php";

//cek username, password, dan nama_file lama
$stmt = $conn->prepare("SELECT username, password, name_file FROM user WHERE username=?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = mysqli_fetch_assoc($result);

//cek apakah ada perubahan salah satu aja
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name_file = basename($_FILES['file']['name']);
    $usernameLama = $user['username'];
    if ($username == $user['username'] and !password_verify($password, $user['password']) or $username != $user['username']) {
        include "edit.php";
    }
    if ($name_file != $user['name_file'] and $name_file != null) {
        include "upload.php";
    } elseif($username != $usernameLama && $user['name_file'] != null) {
        $fileExtension = strtolower(pathinfo($user['name_file'], PATHINFO_EXTENSION));
        rename("./uploads/" . $usernameLama . '.' . $fileExtension, "./uploads/" . $username . '.' . $fileExtension);
    }
    header("Location: index.php");
}
mysqli_close($conn);
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
    <!-- versi mobile -->
    <!-- identitas -->
    <div class="flex w-full items-center pl-4 py-3 gap-2">
        <?php include "./component/identitas.php" ?>
    </div>

    <!-- Logo -->
    <div class="w-full min-h-[85vh] flex flex-col justify-center items-center gap-10">
        <?php if (isset($_SESSION['username'])): ?>
            <?php if (isset($user['name_file'])): ?>
                <div class="shadow-xl shadow-slate-800/60 rounded-full overflow-hidden w-48 h-48">
                    <img class="w-full h-full object-cover object-center" src="./uploads/<?php echo htmlspecialchars($user['username'] . '.' . strtolower(pathinfo($user['name_file'], PATHINFO_EXTENSION))) ?>" alt="foto profile user" />
                </div>
            <?php else: ?>
                <span class="shadow-xl shadow-slate-800/60 rounded-full">
                    <svg class="w-[200px] h-[200px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                    </svg>
                </span>
            <?php endif; ?>
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
                <button type="submit" id="edit" class="bg-amber-500 flex justify-center w-full py-1 shadow-lg shadow-amber-500/60 rounded-full font-medium text-lg text-white">Edit Profile</button>
                <button type="submit" id="delete" class="bg-rose-700 flex justify-center px-6 py-1 shadow-lg shadow-rose-800/60 rounded-full font-medium text-lg text-white">Delete Account</button>
            <?php endif; ?>
        </div>
    </div>
    <!-- cek apakah user benar benar mau hapus akun atau tidak -->
    <?php if (isset($_SESSION['username'])): ?>
        <div id="mengecek" class="bg-white scale-0 divide-y divide-slate-800 rounded-xl shadow-lg shadow-slate-800/60 -translate-x-1/2 -translate-y-1/2 w-2/3 absolute top-1/2 left-1/2">
            <span class="flex items-center justify-evenly pt-4 pb-1">
                <svg class="w-12 h-12 text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-2xl mb-1">Sugar manga</span>
                <span id="close" class="justify-self-end cursor-pointer">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </span>
            </span>
            <div class="pt-2 pb-4 flex flex-col items-center">
                <p class="text-red-800 text-md font-light text-justify px-3 pb-2">Apakah anda yakin ingin menghapus akun anda!</p>
                <a id="fixHapusAkun" href="delete.php" class="bg-rose-700 flex justify-center px-6 py-1 shadow-lg shadow-rose-800/60 rounded-full font-medium text-lg text-white">Delete Account</a>
            </div>
        </div>
        <!-- user mengedit foto profile atau username atau password -->
        <div id="mengedit" class="bg-white scale-0 divide-y divide-slate-800 rounded-xl shadow-lg shadow-slate-800/60 -translate-x-1/2 -translate-y-1/2 w-2/3 absolute top-1/2 left-1/2">
            <span class="flex items-center justify-evenly pt-4 pb-1">
                <svg class="w-12 h-12 text-slate-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-2xl mb-1">Sugar manga</span>
                <span id="closeEdit" class="justify-self-end cursor-pointer">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </span>
            </span>
            <!-- form -->
            <form action="profile.php" method="post" class="flex flex-col p-5 gap-6" enctype="multipart/form-data">
                <div class="flex flex-col justify-center gap-2">
                    <label for="file" class="text-md text-justify tracking-wider">Upload file dalam bentuk format (.jpg, .jpeg, .png, .gif)</label>
                    <input class="outline-0 ring-1 ring-cyan-500 p-2 rounded-md" id="file" name="file" type="file" />
                </div>
                <div class="flex flex-col justify-center gap-2">
                    <label for="username" class="text-xl tracking-wider">Username</label>
                    <input class="outline-0 ring-1 ring-cyan-500 p-2 rounded-md" id="username" name="username" type="text" value=<?php echo htmlspecialchars($user['username']) ?> placeholder="Masukkan username" autocomplete="off" onkeyup="cek_username_edit(this.value)" required />
                    <p id="cek_username_edit" class="text-red-800 text-md font-light"></p>
                </div>
                <div class="flex flex-col justify-center gap-2">
                    <label for="password" class="text-xl tracking-wider">Password</label>
                    <div class="relative flex items-center justify-end">
                        <input class="w-full outline-0 ring-1 ring-cyan-500 p-2 rounded-md" id="password" name="password" type="password" placeholder="Masukkan password" onkeyup="cek_password(this.value)" autocomplete="off" required />
                        <span id="togglePassword" type="submit" class="absolute -translate-x-2 cursor-pointer rounded-full">
                            <svg class="w-6 h-6 text-cyan-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <p id="cek_password" class="text-red-800 text-md font-light text-justify"></p>
                </div>
                <button disabled id="submit" type="submit" name="submit" class="bg-amber-500 flex justify-center w-full py-1 shadow-lg shadow-amber-500/60 rounded-full font-medium text-lg text-white">Edit Profile</button>
            </form>
        </div>
    <?php endif; ?>
    <!-- navbar mobile -->
    <?php include "./component/navbar_mobile.php" ?>
    <!-- validasi -->
    <?php if (isset($_SESSION['username'])): ?>
        <script type="text/javascript" src="./component/validasi_delete_akun.js"></script>
        <script src="./component/validation_form.js"></script>
    <?php endif; ?>
</body>

</html>
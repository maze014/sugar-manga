<?php
session_start();
include "koneksi.php";

if (isset($_POST['submit'])) {
    // Simpan data registasi user
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    // prepared dan bind untuk memasukkan ke database
    $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
    $stmt->bind_param('ss', $username, $hash_password);
    $stmt->execute();
    $_SESSION['username'] = $username;
    $_SESSION['login'] = "Anda berhasil Register";
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
    <title>Register Page</title>
</head>

<body>
    <!-- Mobile version -->
    <!-- identitas -->
    <div class="flex w-full items-center pl-4 py-3 gap-2">
        <?php include "./component/identitas.php" ?>
    </div>

    <!-- form register -->
    <div class="w-full h-[85vh] justify-center items-center flex">
        <form action="register.php" method="POST" class="shadow-lg shadow-slate-800/60 w-[80%] rounded-lg flex flex-col p-5 gap-6">
            <div class="flex flex-col justify-center gap-2">
                <label for="username" class="text-xl tracking-wider">Username</label>
                <input class="outline-0 ring-1 ring-cyan-500  p-2 rounded-md" id="username" name="username" type="text" placeholder="Masukkan username" autocomplete="off" onkeyup="cek_username(this.value)" required />
                <p id="cek_username" class="text-red-800 text-md font-light"></p>
            </div>
            <div class="flex flex-col justify-center gap-2">
                <label for="password" class="text-xl tracking-wider">Password</label>
                <div class="relative flex items-center justify-end">
                    <input class="w-full outline-0 ring-1 ring-cyan-500  p-2 rounded-md" id="password" name="password" type="password" placeholder="Masukkan password" autocomplete="off" onkeyup="cek_password(this.value)" required />
                    <span id="togglePassword" type="submit" class="absolute -translate-x-2 cursor-pointer rounded-full">
                        <svg class="w-6 h-6 text-cyan-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <p id="cek_password" class="text-red-800 text-md font-light text-justify"></p>
            </div>
            <button disabled id="submit" name="submit" type="submit" class="bg-violet-700 rounded-full w-1/2 mx-auto font-medium text-lg text-white py-1 shadow-lg shadow-violet-800/60">Register</button>
        </form>
    </div>

    <!-- navbar -->
    <?php include "./component/navbar_mobile.php"; ?>
    <!-- validasi form -->
    <script type="text/javascript" src="./component/validation_form.js"></script>
</body>

</html>
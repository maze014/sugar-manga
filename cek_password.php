<?php
session_start();
include "koneksi.php";

// validasi password
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $upperCase = preg_match('/[A-Z]/', $password);
    $lowerCase = preg_match('/[a-z]/', $password);
    $number = preg_match('/[0-9]/', $password);
    $specialChar = preg_match('/[^\w]/', $password);
    $response = 'Password harus ';
    if (strlen($password) < 8) {
        $response .= 'lebih dari 7 karakter, ';
    }
    if (!$upperCase) {
        $response .= 'ada huruf besar, ';
    }
    if (!$lowerCase) {
        $response .= 'ada huruf kecil, ';
    }
    if (!$number) {
        $response .= 'ada angka, ';
    }
    if (!$specialChar) {
        $response .= 'ada special karakter, ';
    }
    $response[strlen($response) - 2] = '.';
    if (strlen($password) >= 8 && $upperCase && $lowerCase && $number && $specialChar)
        $response = '';
    if (strlen($password) == 0)
        $response = '';
    echo $response;
}

//validasi username sudah digunakan form register
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $stmt = $conn->prepare("SELECT username FROM user WHERE username=?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        echo "Username sudah digunakan";
    }
}

//validasi username sudah digunakan form edit profile
if (isset($_POST['usernameEdit'])) {
    $usernameEdit = $_POST['usernameEdit'];

    $stmt = $conn->prepare("SELECT username FROM user WHERE username=?");
    $stmt->bind_param('s', $usernameEdit);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = mysqli_fetch_assoc($result);
    if ($data != null && $data['username'] != $_SESSION['username']) {
        echo "Username sudah digunakan";
    }
}

//menambahkan favorite ke table favorite menggunakan ajax
if (isset($_POST['favorite'])) {
    $favorite = $_POST['favorite'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT username, id_image FROM favorite WHERE username=? and id_image=?");
    $stmt->bind_param('ss', $username, $favorite);
    $stmt->execute();
    $idImg = $stmt->get_result();
    $idImg = mysqli_fetch_assoc($idImg);
    
    if(!$idImg) {
        $stmt = $conn->prepare("INSERT INTO favorite (username, id_image) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $favorite);
        $stmt->execute();
    }
}

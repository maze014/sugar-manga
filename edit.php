<?php
//prepared and bind untuk update username dan password
$hash_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE user SET username=?, password=? WHERE username=?");
$stmt->bind_param('sss', $username, $hash_password, $user['username']);
$stmt->execute();

$_SESSION['username'] = $username;
$_SESSION['pesan_edit'] = "Anda berhasil mengedit profile";

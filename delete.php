<?php 
session_start();
include "koneksi.php";

//prepared dan bind untuk delete akun
$stmt = $conn->prepare("DELETE FROM user WHERE username=?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
unset($_SESSION['username']);
$_SESSION['delete'] = 'Anda berhasil delete Account';
header("Location: index.php");

mysqli_close($conn);
?>
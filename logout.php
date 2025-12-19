<?php
session_start();
unset($_SESSION['username']);
$_SESSION['logout'] = "Anda berhasil Log Out";
header("Location: index.php");
?>
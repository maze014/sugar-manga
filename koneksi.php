<?php 
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "db_mangaapp";

    // connect ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
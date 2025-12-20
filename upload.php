<?php 
$target_dir = "uploads/";
$target_file = "";
$file_size = "";
if(isset($_FILES['fileToUpload']['name'])) {
    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
}
if(isset($_FILES['fileToUpload']['size'])) {
    $file_size = $_FILES['fileToUpload']['size'];
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//cek apakah ini file gambar asli atau falsu
if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

//cek file sudah ada atau masih belum
if(file_exists($target_file)) {
    $uploadOk = 0;
}

//cek file size lebih dari 2 mb atau 2000000 byte
if($file_size > 2000000) {
    $uploadOk = 0;
}

//izinkan sebagian format file
if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
    $uploadOk = 0;
}

if($uploadOk == 0) {
    //nanti ada flash message
} else {
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        //flash message
    } else {
        //flash message
    }
}
?>
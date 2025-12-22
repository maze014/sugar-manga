<?php
$target_dir = "uploads/";
$target_file = $target_dir . $_SESSION['username'];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $_SESSION['pesan_edit_upload'] =  "Maaf, hanya JPG, JPEG, PNG dan GIF file yang bisa di upload";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 1000000 and $uploadOk == 1) {
    $_SESSION['pesan_edit_upload'] = "Maaf, size file anda melebihi 1 mb";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 1
if ($uploadOk == 1 and !($userBaru != null and $userBaru['username'] != $user['username'])) {
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file . '.' . $imageFileType);
    //query update name_file ke db
    $stmt = $conn->prepare("UPDATE user SET name_file=? WHERE username=?");
    $stmt->bind_param('ss', $name_file, $_SESSION['username']);
    $stmt->execute();
    $_SESSION['pesan_edit'] = "Anda berhasil mengedit profile";
} 

<?php

include '../koneksi.php';

$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$deskripsi = $_POST['deskripsi'];
$pencapaian = $_POST['pencapaian'];

// Proses Upload Gambar
$foto_name = $_FILES['foto']['name'];
$tmp_name = $_FILES['foto']['tmp_name'];
$ext = pathinfo($foto_name, PATHINFO_EXTENSION);
$new_name = 'profile_'.time().'.'.$ext;
$upload_path = 'assets/uploads/'.$new_name;

if (move_uploaded_file($tmp_name, $upload_path)) {
    $sql = "INSERT INTO karir (nama, jabatan, deskripsi, pencapaian, foto) 
            VALUES ('$nama', '$jabatan', '$deskripsi', '$pencapaian', '$new_name')";

    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
}

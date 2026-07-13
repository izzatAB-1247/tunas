<?php

session_start();
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $email = $_POST['email'];

    // Inisialisasi variabel foto
    $query_foto = '';

    // Cek apakah ada file yang diupload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $nama_file = $_FILES['foto']['name'];
        $ukuran_file = $_FILES['foto']['size'];
        $tmp_name = $_FILES['foto']['tmp_name'];

        // Ekstensi yang diperbolehkan
        $ekstensi_valid = ['jpg', 'jpeg', 'png'];
        $ekstensi_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

        if (in_array($ekstensi_file, $ekstensi_valid) && $ukuran_file < 2000000) { // Max 2MB
            // Beri nama unik agar tidak tertukar
            $nama_baru = 'guru_'.$user_id.'_'.time().'.'.$ekstensi_file;
            // Tanpa garis miring di depan assets
            $tujuan = 'assets/img/profile/'.$nama_baru;

            // Buat folder jika belum ada
            if (! is_dir('assets/img/profile/')) {
                mkdir('assets/img/profile/', 0777, true);
            }

            if (move_uploaded_file($tmp_name, $tujuan)) {
                $query_foto = ", foto = '$nama_baru'";
            }
        }
    }

    $sql = "UPDATE users SET 
            nama_depan = '$nama_depan', 
            nama_belakang = '$nama_belakang', 
            email = '$email' 
            $query_foto 
            WHERE id = '$user_id'";

    if ($conn->query($sql)) {
        header('Location: dashboard.php?status=success');
    } else {
        header('Location: dashboard.php?status=error');
    }
}

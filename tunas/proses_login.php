<?php

session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = 'SELECT * FROM users WHERE email = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // 1. Cek password
    if (password_verify($password, $row['password'])) {

        // 2. Simpan session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['nama'] = $row['nama_depan'].' '.$row['nama_belakang'];
        $_SESSION['role'] = $row['role'];

        $user_id = $row['id'];
        $role = $row['role'];

        // 3. LOGIKA TAMBAHAN: Catat log_login jika yang login adalah SISWA
        if ($role === 'siswa') {
            $user_id = $row['id'];

            // Ambil satu ID Guru yang valid dari database agar tidak error Foreign Key
            // Kita ambil guru dengan ID terkecil sebagai default penampung log
            $qCekGuru = $conn->query("SELECT id FROM users WHERE role = 'guru' LIMIT 1");
            $dCekGuru = $qCekGuru->fetch_assoc();
            $guru_pencatat = $dCekGuru['id'];

            $stmt_log = $conn->prepare('INSERT INTO log_login (siswa_user_id, guru_user_id, waktu_login) VALUES (?, ?, NOW())');
            $stmt_log->bind_param('ii', $user_id, $guru_pencatat);
            $stmt_log->execute();
        }

        // 4. Arahkan berdasarkan role
        if ($role === 'admin') {
            header('Location: admin/dashboard.php');
        } elseif ($role === 'guru') {
            header('Location: guru/dashboard.php');
        } elseif ($role === 'siswa') {
            header('Location: siswa/dashboard.php');
        }
        exit();

    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }

} else {
    echo "<script>alert('Email tidak ditemukan!'); window.location='login.php';</script>";
}

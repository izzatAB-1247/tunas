<?php

// ==========================================
// PROSES REGISTER TUNAS
// ==========================================
session_start();
include 'koneksi.php';

// ==========================================
// AMBIL DATA DARI FORM
// ==========================================

$role = $_POST['role'] ?? '';
$namaDepan = $_POST['namaDepan'] ?? '';
$namaBelakang = $_POST['namaBelakang'] ?? '';
$email = $_POST['email'] ?? '';
$telepon = $_POST['telepon'] ?? '';
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirmPassword'] ?? '';

$nip = $_POST['nip'] ?? '';
$nis = $_POST['nis'] ?? '';
$kelas = $_POST['kelas'] ?? '';

// ==========================================
// VALIDASI AWAL
// ==========================================

if ($password !== $confirm) {
    exit("<script>alert('Password tidak cocok!'); history.back();</script>");
}

if (strlen($password) < 8) {
    exit("<script>alert('Password minimal 8 karakter!'); history.back();</script>");
}

// Hash Password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ==========================================
// CEK EMAIL DUPLIKAT
// ==========================================

$cekEmail = $conn->prepare('SELECT id FROM users WHERE email = ?');
$cekEmail->bind_param('s', $email);
$cekEmail->execute();
$cekEmail->store_result();

if ($cekEmail->num_rows > 0) {
    exit("<script>alert('Email sudah terdaftar! Silakan gunakan email lain.'); history.back();</script>");
}

// ==========================================
// INSERT KE TABEL USERS
// ==========================================

$stmt = $conn->prepare('
    INSERT INTO users (nama_depan, nama_belakang, email, telepon, password, role)
    VALUES (?, ?, ?, ?, ?, ?)
');
$stmt->bind_param(
    'ssssss',
    $namaDepan,
    $namaBelakang,
    $email,
    $telepon,
    $hashedPassword,
    $role
);

if (! $stmt->execute()) {
    exit("<script>alert('Gagal membuat akun user!'); history.back();</script>");
}

// Ambil ID user baru
$user_id = $stmt->insert_id;

// ==========================================
// JIKA ROLE GURU → SIMPAN KE TABEL guru
// ==========================================

if ($role === 'guru') {

    if ($nip === '') {
        exit("<script>alert('NIP tidak boleh kosong!'); history.back();</script>");
    }

    $stmt2 = $conn->prepare('
        INSERT INTO guru (user_id, nip)
        VALUES (?, ?)
    ');
    $stmt2->bind_param('is', $user_id, $nip);

    if (! $stmt2->execute()) {
        exit("<script>alert('Gagal menyimpan data guru!'); history.back();</script>");
    }

}

// ==========================================
// JIKA ROLE SISWA → SIMPAN KE TABEL siswa
// ==========================================

if ($role === 'siswa') {

    if ($nis === '' || $kelas === '') {
        exit("<script>alert('NIS dan kelas wajib diisi!'); history.back();</script>");
    }

    $stmt3 = $conn->prepare('
        INSERT INTO siswa (user_id, nis, kelas)
        VALUES (?, ?, ?)
    ');
    $stmt3->bind_param('iss', $user_id, $nis, $kelas);

    if (! $stmt3->execute()) {
        exit("<script>alert('Gagal menyimpan data siswa!'); history.back();</script>");
    }

}

// ==========================================
// SELESAI – ARAHKAN KE HALAMAN LOGIN
// ==========================================

echo "<script>
        alert('Registrasi berhasil! Silakan login.');
        window.location.href = 'login.php';
      </script>";

$conn->close();

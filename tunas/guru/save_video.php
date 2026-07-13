<?php

header('Content-Type: application/json');

session_start();
include '../koneksi.php';

// Cek koneksi
if ($conn->connect_error) {
    exit(json_encode([
        'success' => false,
        'message' => 'Koneksi database gagal: '.$conn->connect_error,
    ]));
}

$conn->set_charset('utf8mb4');

// Jika request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Validasi data (Menyertakan pengecekan 'tipe')
    if (empty($data['judul']) || empty($data['kategori']) || empty($data['youtube_id']) || empty($data['tipe'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak lengkap (Judul, Kategori, Youtube ID, dan Tipe wajib diisi)',
        ]);
        exit;
    }

    $judul = $conn->real_escape_string($data['judul']);
    $kategori = $conn->real_escape_string($data['kategori']);
    $deskripsi = $conn->real_escape_string($data['deskripsi'] ?? '');
    $url = $conn->real_escape_string($data['url'] ?? '');
    $youtube_id = $conn->real_escape_string($data['youtube_id']);
    $tipe = $conn->real_escape_string($data['tipe']);

    // Query untuk insert data
    $sql = "INSERT INTO videos (judul, kategori, deskripsi, url, youtube_id, tipe, created_at) 
            VALUES ('$judul', '$kategori', '$deskripsi', '$url', '$youtube_id', '$tipe', NOW())";

    if ($conn->query($sql) === true) {
        // Logika pesan sukses yang lebih rapi untuk user
        $labelTipe = ($tipe === 'kosa_kata') ? 'Kosa Kata' : ucfirst($tipe);

        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil ditambahkan ke kategori '.$labelTipe,
            'id' => $conn->insert_id,
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error database: '.$conn->error,
        ]);
    }
}

$conn->close();

<?php

header('Content-Type: application/json');

session_start();
include '../koneksi.php';

// Cek koneksi
if ($conn->connect_error) {
    exit(json_encode([
        'success' => false,
        'message' => 'Koneksi database gagal: '.$conn->connect_error,
        'videos' => [],
    ]));
}

$conn->set_charset('utf8mb4');

/**
 * MENGAMBIL PARAMETER TIPE
 * Jika dipanggil 'get_videos.php?tipe=pelatihan' maka akan mengambil video pelatihan.
 * Jika dipanggil tanpa parameter, defaultnya mengambil 'bisindo'.
 */
$tipe = isset($_GET['tipe']) ? $conn->real_escape_string($_GET['tipe']) : 'bisindo';

// Tambahkan kolom 'tipe' pada filter WHERE agar data tidak bercampur
$sql = "SELECT id, judul, kategori, deskripsi, url, youtube_id, tipe, created_at 
        FROM videos 
        WHERE tipe = '$tipe' 
        ORDER BY created_at DESC";

$result = $conn->query($sql);

$videos = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
}

echo json_encode([
    'success' => true,
    'message' => 'Data berhasil diambil untuk tipe: '.$tipe,
    'videos' => $videos,
    'total' => count($videos),
]);

$conn->close();

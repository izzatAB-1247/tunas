<?php

// Letakkan di paling atas untuk menghindari error output
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Izin akses
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

include '../koneksi.php'; // PASTIKAN PATH INI BENAR

// Ambil data JSON
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (! isset($data['id']) || ! isset($data['tabel'])) {
    echo json_encode(['success' => false, 'message' => 'ID atau Tabel tidak ditemukan']);
    exit;
}

$id = (int) $data['id'];
$tabel = $conn->real_escape_string($data['tabel']);

// Validasi tabel
$allowed = ['kuis', 'videos', 'karir'];
if (! in_array($tabel, $allowed)) {
    echo json_encode(['success' => false, 'message' => 'Tabel dilarang']);
    exit;
}

// Eksekusi hapus
$sql = "DELETE FROM $tabel WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$conn->close();

<?php

// Pastikan tidak ada spasi atau baris kosong sebelum tag <?php
header('Content-Type: application/json');
include '../koneksi.php';

// Matikan error reporting agar tidak merusak format JSON jika ada peringatan kecil
error_reporting(0);

$tipe = isset($_GET['tipe']) ? $conn->real_escape_string($_GET['tipe']) : 'bisindo';

$sql = "SELECT * FROM kuis WHERE tipe = '$tipe' ORDER BY id DESC";
$result = $conn->query($sql);

$kuis = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $kuis[] = [
            'id' => $row['id'],
            'question' => $row['pertanyaan'],
            'emoji' => $row['emoji'],
            'options' => [$row['opsi_a'], $row['opsi_b'], $row['opsi_c'], $row['opsi_d']],
            'correct' => (int) $row['jawaban_benar'],
        ];
    }

    echo json_encode([
        'success' => true,
        'data' => $kuis,
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => $conn ? $conn->error : 'Database error',
    ]);
}

$conn->close();

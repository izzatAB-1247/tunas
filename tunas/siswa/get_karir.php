<?php

// Pastikan tidak ada spasi/output sebelum tag php
header('Content-Type: application/json');
include '../koneksi.php'; // Sesuaikan path koneksi Anda

// Matikan error reporting agar tidak merusak format JSON
error_reporting(0);

$sql = 'SELECT * FROM karir ORDER BY id DESC';
$result = $conn->query($sql);

$dataKarir = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $dataKarir[] = [
            'id' => $row['id'],
            'nama' => $row['nama'],
            'jabatan' => $row['jabatan'],
            'deskripsi' => $row['deskripsi'],
            'pencapaian' => $row['pencapaian'], // Berupa string yang dipisah koma
            'foto' => $row['foto'],
        ];
    }

    echo json_encode([
        'success' => true,
        'data' => $dataKarir,
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengambil data: '.$conn->error,
    ]);
}

$conn->close();

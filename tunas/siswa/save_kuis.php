<?php

header('Content-Type: application/json');
include '../koneksi.php';

// Mengambil data JSON dari fetch
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (! empty($data['pertanyaan'])) {
    $p = $data['pertanyaan'];
    // Jika emoji kosong, berikan default. Jika ada Base64 gambar, biarkan apa adanya.
    $e = ! empty($data['emoji']) ? $data['emoji'] : '📝';
    $a = $data['opsi_a'];
    $b = $data['opsi_b'];
    $c = $data['opsi_c'];
    $d = $data['opsi_d'];
    $jb = (int) $data['jawaban_benar'];
    $tipe = $data['tipe'];

    // MENGGUNAKAN PREPARED STATEMENT (Lebih stabil untuk data besar/gambar)
    $sql = 'INSERT INTO kuis (pertanyaan, emoji, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar, tipe) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);

    // "ssssssis" berarti string, string, string, string, string, string, integer, string
    $stmt->bind_param('ssssssis', $p, $e, $a, $b, $c, $d, $jb, $tipe);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Pertanyaan tidak boleh kosong']);
}

$conn->close();

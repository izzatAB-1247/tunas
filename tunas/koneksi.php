
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tunas_db'; // GANTI DENGAN NAMA DATABASE KAMU

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    exit('Koneksi gagal: '.$conn->connect_error);
}
?>
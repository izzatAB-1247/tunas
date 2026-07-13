<?php
require_once '../koneksi.php';

$guru_user_id = $_SESSION['user_id'];

/* ======================
   DATA GURU + EMAIL
====================== */
/* ======================
    DATA GURU + EMAIL
====================== */
/* ======================
    DATA GURU + EMAIL
====================== */
/* ======================
    DATA GURU + EMAIL
====================== */
$qGuru = $conn->query("
    SELECT u.nama_depan, u.nama_belakang, u.email, u.foto -- Pastikan ada u.foto di sini
    FROM guru g
    JOIN users u ON g.user_id = u.id
    WHERE g.user_id = '$guru_user_id'
");

$dataGuru = $qGuru->fetch_assoc();

// If no guru record found, initialize default values to prevent errors
if (! $dataGuru) {
    $full_name = 'Pengguna';
    $email_guru = 'Email tidak ditemukan';
} else {
    $full_name = $dataGuru['nama_depan'].' '.$dataGuru['nama_belakang'];
    $email_guru = $dataGuru['email'];
}

/* ======================
   TOTAL LOGIN (SEMUA SISWA)
====================== */
// Kita hitung semua baris tanpa mempedulikan siapa gurunya
$qLogin = $conn->query('SELECT COUNT(*) AS total FROM log_login');
$total_login_siswa = $qLogin->fetch_assoc()['total'] ?? 0;

/* ======================
   RATA-RATA NILAI (SEMUA SISWA)
====================== */
// Kita ambil rata-rata nilai seluruh siswa di sistem
$qNilai = $conn->query('SELECT AVG(nilai) AS rata FROM nilai');
$rata_nilai = $qNilai->fetch_assoc()['rata'] ?? 0;
?>

 
 <!-- Welcome -->
    <div class="welcome-box mb-4">
      <h2>Halo <?= htmlspecialchars($full_name) ?>! 👋</h2>
        <p>Semoga hari mengajar Anda penuh semangat dan inspirasi! 🌈</p>
    </div>

    <!-- Stats -->
   <!-- PROFIL GURU -->
<div class="profile-card mb-4 p-4">
    <div class="d-flex align-items-center gap-4">
     <?php
// 1. Tentukan path dasar folder foto
$path_foto = 'assets/img/profile/';

// 2. Cek apakah kolom foto di database ada isinya DAN filenya benar-benar ada di folder
if (! empty($dataGuru['foto']) && file_exists($path_foto.$dataGuru['foto'])) {
    $tampilan_foto = $path_foto.$dataGuru['foto'];
} else {
    // Jika tidak ada, pakai gambar default
    $tampilan_foto = 'assets/img/default-avatar.png';
}
?>

<img src="<?= $tampilan_foto ?>?t=<?= time(); ?>" class="profile-img" 
     style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
        <div>
        <h4 class="mb-1"><?= htmlspecialchars($full_name) ?></h4>
<p class="text-muted mb-2"><?= htmlspecialchars($email_guru) ?></p>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfil">
                ✏️ Edit Profil
            </button>
        </div>
    </div>
</div>

   <div class="row g-4">

    <!-- Statistik Login -->
    <div class="col-md-6">
        <div class="stat-card">
            <div class="emoji">🔐</div>
            <h5>Total Login Siswa</h5>
           <h3><?= $total_login_siswa ?></h3>
            <small class="text-muted">Data siswa bimbingan Anda</small>
        </div>
    </div>

    <!-- Rata-rata Nilai -->
    <div class="col-md-6">
        <div class="stat-card">
            <div class="emoji">📊</div>
            <h5>Rata-rata Nilai Siswa</h5>
          <h3><?= number_format($rata_nilai, 1) ?></h3>
            <small class="text-muted">Nilai akademik terbaru</small>
        </div>
    </div>

</div>

    <!-- Grafik Pastel -->
    <div class="mt-5 p-4" style="background:white; border-radius:25px; box-shadow:0 8px 20px rgba(0,0,0,0.06);">
        <h4 class="mb-3 fw-bold">📊 Statistik Kehadiran Siswa (Cute Chart)</h4>
        <canvas id="cuteChart" height="130"></canvas>
    </div>

   <div class="modal fade" id="editProfil" tabindex="-1" aria-labelledby="editProfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
          <form method="post" action="update_profil.php" enctype="multipart/form-data">
    <label class="small mb-1">Nama Depan</label>
    <input type="text" name="nama_depan" class="form-control mb-2" value="<?= htmlspecialchars($dataGuru['nama_depan'] ?? '') ?>" required>
    
    <label class="small mb-1">Nama Belakang</label>
    <input type="text" name="nama_belakang" class="form-control mb-2" value="<?= htmlspecialchars($dataGuru['nama_belakang'] ?? '') ?>" required>
    
    <label class="small mb-1">Email</label>
    <input type="email" name="email" class="form-control mb-2" value="<?= htmlspecialchars($email_guru) ?>" required>

    <label class="small mb-1">Foto Profil (Opsional)</label>
    <input type="file" name="foto" class="form-control mb-3" accept="image/*">
    
    <button type="submit" class="btn btn-primary w-100 shadow-sm">Simpan Perubahan</button>
</form>
        </div>
    </div>
</div>


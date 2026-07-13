<?php
session_start();

if (! isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SESSION['role'] !== 'guru') {
    header('Location: ../unauthorized.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - TUNAS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font Cute -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/tunas/guru/css/style.css">
   
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <a class="navbar-brand" href="#">
                    <i class="bi bi-hand-index-thumb"></i>
                    TUNAS
                </a>

    <div class="profile-box">
        <img src="../assets/user.png" alt="profil">
        <h5><?= $_SESSION['nama'] ?></h5>
        <p class="text-muted" style="font-size: 14px; margin:0;">Guru Pembimbing</p>
    </div>

   <div class="menu">
    <a href="dashboard.php?page=beranda" class="menu-item">
        <i class="bi bi-house-heart-fill"></i> Beranda
    </a>

    <a href="dashboard.php?page=pelatihan" class="menu-item">
        <i class="bi bi-award-fill"></i> Pelatihan Persiapan Kerja
    </a>

    <a href="dashboard.php?page=video" class="menu-item">
        <i class="bi bi-camera-video-fill"></i> Vokasional
    </a>

    <a href="dashboard.php?page=kuis" class="menu-item">
        <i class="bi bi-controller"></i> Kuis
    </a>

    <a href="dashboard.php?page=karier" class="menu-item">
        <i class="bi bi-briefcase-fill"></i> Karier
    </a>

    <a href="dashboard.php?page=kamus" class="menu-item">
        <i class="bi bi-book"></i> Kosa Kata BISINDO
    </a>

    <a href="../logout.php" class="menu-item text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>


</div>

<div class="main-content">
    <?php
$page = isset($_GET['page']) ? $_GET['page'] : 'beranda';

switch ($page) {

    case 'pelatihan':
        include 'pelatihan.php';
        break;

    case 'video':
        include 'video.php';
        break;

    case 'kuis':
        include 'kuis.php';
        break;

    case 'karier':
        include 'karier.php';
        break;

    case 'kamus':
        include 'kamus.php';
        break;

    default:
        include 'beranda.php'; // halaman default
        break;

}
?>

</div>



<script>
    // Chart Cute Pastel
    const ctx = document.getElementById('cuteChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
            datasets: [{
                label: 'Kehadiran',
                data: [30, 28, 33, 31, 29],
                borderWidth: 4,
                tension: 0.4,
                borderColor: '#8bb0ff',
                backgroundColor: '#dbe6ff'
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    ticks: { color: '#777' }
                },
                x: {
                    ticks: { color: '#777' }
                }
            }
        }
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Karier Inspiratif</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --bg-light: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-main);
            padding-top: 50px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header h1 {
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        /* Glassmorphism Effect for Search/Buttons */
        .action-bar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .profiles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .profile-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .profile-image-wrapper {
            width: 100%;
            height: 280px;
            overflow: hidden;
            position: relative;
        }

        .profile-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .profile-card:hover .profile-image-wrapper img {
            transform: scale(1.05);
        }

        .profile-content {
            padding: 25px;
        }

        .profile-title-tag {
            display: inline-block;
            background: #eef2ff;
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .profile-name {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .profile-description {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .achievement-pill {
            background: #f1f5f9;
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .achievement-pill i {
            color: #10b981;
        }

        /* Buttons Styling */
        .btn-custom {
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            color: white;
        }

        /* Modal Aesthetic */
        .modal-content {
            border: none;
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
        }

        @media (max-width: 768px) {
            .profiles-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>🌟 Profil Karier Inspiratif</h1>
        <p class="text-secondary">Kisah Sukses Individu Tunarungu yang Menginspirasi Dunia</p>
    </div>

    <div class="action-bar">
        <button class="btn btn-custom btn-primary-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#modalKarir">
            <i class="bi bi-plus-lg me-2"></i>Tambah Profil
        </button>
        <button class="btn btn-custom btn-outline-dark" onclick="openManageKarir()">
            <i class="bi bi-gear me-2"></i>Kelola
        </button>
    </div>

    <div class="profiles-grid" id="profileGrid">
        <div class="text-center w-100 py-5" id="loadingState">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2 text-muted">Memuat inspirasi...</p>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKarir" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h3 class="fw-bold">Bagikan Kisah Baru</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formKarir">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Andi Prasetyo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jabatan/Bidang</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Software Developer" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Ceritakan singkat kisah suksesnya..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pencapaian (Pisahkan dengan koma)</label>
                        <input type="text" name="pencapaian" class="form-control" placeholder="Juara 1, Founder, dsb" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-custom btn-primary-custom w-100 py-3 shadow">
                        Terbitkan Profil <i class="bi bi-send ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="manageContentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="fw-bold m-0">Kelola Data Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="manageContentList" class="list-group list-group-flush">
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Memuat Data Karier
    async function loadProfiles() {
        const grid = document.getElementById('profileGrid');
        try {
            const response = await fetch('get_karir.php');
            const result = await response.json();
            
            if (result.success && result.data.length > 0) {
                grid.innerHTML = result.data.map(p => {
                    const items = p.pencapaian.split(',');
                    const listHtml = items.map(item => 
                        item.trim() ? `<div class="achievement-pill"><i class="bi bi-check-circle-fill"></i> ${item.trim()}</div>` : ''
                    ).join('');

                    return `
                    <div class="profile-card">
                        <div class="profile-image-wrapper">
                            <img src="assets/uploads/${p.foto}" alt="${p.nama}" loading="lazy">
                        </div>
                        <div class="profile-content">
                            <span class="profile-title-tag">${p.jabatan}</span>
                            <h3 class="profile-name">${p.nama}</h3>
                            <p class="profile-description">${p.deskripsi}</p>
                            <div class="achievements-list">
                                ${listHtml}
                            </div>
                        </div>
                    </div>`;
                }).join('');
            } else {
                grid.innerHTML = '<div class="text-center py-5 w-100"><i class="bi bi-inbox fs-1 text-muted"></i><p class="text-muted mt-2">Belum ada data profil.</p></div>';
            }
        } catch (error) {
            grid.innerHTML = '<p class="text-danger text-center">Gagal memuat data.</p>';
        }
    }

    // Handler Submit Form
    document.getElementById('formKarir').onsubmit = async (e) => {
        e.preventDefault();
        const btn = e.target.querySelector('button');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

        try {
            const response = await fetch('save_karir.php', {
                method: 'POST',
                body: new FormData(e.target)
            });
            const res = await response.json();
            
            if (res.success) {
                alert("✨ Profil berhasil ditambahkan!");
                location.reload();
            } else {
                alert("Gagal: " + res.message);
            }
        } catch (error) {
            alert("Terjadi kesalahan.");
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    };

    // Modal Kelola
    async function openManageKarir() {
        const list = document.getElementById('manageContentList');
        list.innerHTML = '<div class="text-center p-4"><div class="spinner-border text-primary"></div></div>';
        
        const response = await fetch('get_karir.php');
        const result = await response.json();
        
        if (result.success) {
            list.innerHTML = result.data.map(p => `
                <div class="list-group-item d-flex justify-content-between align-items-center border-0 mb-2 shadow-sm rounded-4 p-3">
                    <div class="d-flex align-items-center">
                        <img src="assets/uploads/${p.foto}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <div class="fw-bold">${p.nama}</div>
                            <small class="text-muted">${p.jabatan}</small>
                        </div>
                    </div>
                    <button onclick="hapusData(${p.id}, 'karir')" class="btn btn-outline-danger btn-sm border-0 rounded-circle p-2">
                        <i class="bi bi-trash3 fs-5"></i>
                    </button>
                </div>
            `).join('');
        }
        new bootstrap.Modal(document.getElementById('manageContentModal')).show();
    }

    // Hapus Data
    async function hapusData(id, table) {
        if (!confirm("Hapus profil ini secara permanen?")) return;

        try {
            const response = await fetch('delete.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, tabel: table })
            });
            const res = await response.json();
            if (res.success) {
                location.reload();
            } else {
                alert("Gagal menghapus.");
            }
        } catch (e) {
            alert("Kesalahan jaringan.");
        }
    }

    window.onload = loadProfiles;
</script>
</body>
</html>
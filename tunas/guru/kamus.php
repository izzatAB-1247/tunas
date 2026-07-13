<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosa Kata BISINDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Menggunakan style yang sama dengan halaman Video Anda agar konsisten */
        .container { padding: 25px; animation: fadeIn .4s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        .category-pill {
            padding: 8px 18px; border-radius: 20px; background: #f3e8ff;
            color: #581c87; margin-right: 8px; margin-bottom: 8px;
            cursor: pointer; transition: all 0.3s; font-size: 0.9rem; border: none;
        }
        .category-pill:hover { background: #e9d5ff; transform: translateY(-2px); }
        .category-pill.active { background: #a855f7; color: white; }

        .video-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px; margin-top: 20px;
        }
        .video-card {
            background: white; border-radius: 12px; overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s; cursor: pointer;
        }
        .video-card:hover { transform: translateY(-5px); box-shadow: 0 4px 16px rgba(0,0,0,0.15); }
        .video-thumbnail { width: 100%; height: 160px; object-fit: cover; background: #e9ecef; }
        .video-info { padding: 15px; }
        .video-title { font-weight: 600; color: #212529; margin-bottom: 5px; }
        .video-category {
            display: inline-block; padding: 4px 10px; background: #f3f4f6;
            color: #4b5563; border-radius: 12px; font-size: 0.75rem; margin-bottom: 8px;
        }

        /* Tombol Aesthetic */
        .btn-aesthetic {
            border: none; border-radius: 12px; padding: 10px 20px;
            font-weight: 600; display: inline-flex; align-items: center;
            transition: all 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-purple-soft { background-color: #f3e8ff; color: #6b21a8; }
        .btn-purple-soft:hover { background-color: #6b21a8; color: white; transform: translateY(-2px); }
        .btn-manage-soft { background-color: #fef3c7; color: #92400e; }
        .btn-manage-soft:hover { background-color: #d97706; color: white; transform: translateY(-2px); }

        .play-icon {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            font-size: 2.5rem; color: white; opacity: 0; transition: 0.3s;
        }
        .video-card:hover .play-icon { opacity: 1; }
        .thumbnail-wrapper { position: relative; }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold mb-0">📖 Kosa Kata BISINDO</h2>
        <div class="d-flex gap-2">
            <button class="btn btn-aesthetic btn-purple-soft" data-bs-toggle="modal" data-bs-target="#addWordModal">
                <i class="bi bi-plus-circle-fill me-2"></i>Tambah Kata
            </button>
            <button class="btn btn-aesthetic btn-manage-soft" onclick="openManageWords()">
                <i class="bi bi-pencil-square me-2"></i>Kelola
            </button>
        </div>
    </div>

    <div class="input-group mb-4 shadow-sm">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
        <input id="searchInput" type="text" class="form-control border-start-0" placeholder="Cari kosa kata (misal: Ayah, Makan, Tolong)...">
    </div>

    <div class="mb-4 d-flex flex-wrap">
        <button class="category-pill active" data-category="Semua">Semua</button>
        <button class="category-pill" data-category="Keluarga">Keluarga</button>
        <button class="category-pill" data-category="Kata Kerja">Kata Kerja</button>
        <button class="category-pill" data-category="Benda">Benda</button>
        <button class="category-pill" data-category="Waktu">Waktu</button>
        <button class="category-pill" data-category="Sifat">Sifat</button>
    </div>

    <div id="loadingState" class="text-center py-5">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Memuat kosa kata...</p>
    </div>

    <div id="videoGrid" class="video-grid"></div>
    
    <div id="emptyState" class="text-center py-5" style="display: none;">
        <i class="bi bi-book text-muted" style="font-size: 4rem;"></i>
        <h4 class="mt-3">Kosa kata tidak ditemukan</h4>
        <p>Coba gunakan kata kunci lain.</p>
    </div>
</div>

<div class="modal fade" id="addWordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addWordForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Kosa Kata Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kosa Kata</label>
                        <input type="text" class="form-control" id="wordName" placeholder="Contoh: Terima Kasih" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL YouTube (Contoh Isyarat)</label>
                        <input type="text" class="form-control" id="youtubeURL" placeholder="https://youtube.com/..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" id="wordCategory" required>
                            <option value="Keluarga">Keluarga</option>
                            <option value="Kata Kerja">Kata Kerja</option>
                            <option value="Benda">Benda</option>
                            <option value="Waktu">Waktu</option>
                            <option value="Sifat">Sifat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penjelasan Singkat</label>
                        <textarea class="form-control" id="wordDesc" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100 py-2">Simpan Kosa Kata</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="manageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Daftar Kosa Kata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="manageList" class="list-group"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="playerTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let vocabulary = [];

// Fungsi pembantu untuk mendapatkan ID dan Thumbnail YouTube
const getYTID = (url) => {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
};

const getThumb = (id) => `https://img.youtube.com/vi/${id}/mqdefault.jpg`;

// Memuat Data dengan filter tipe=kosa_kata
async function loadData() {
    try {
        // Menggunakan parameter tipe=kosa_kata sesuai logika di get_videos.php
        const response = await fetch('get_videos.php?tipe=kosa_kata'); 
        const data = await response.json();
        
        if (data.success) {
            vocabulary = data.videos; // Mengambil array video dari response
            renderItems();
        }
    } catch (e) { 
        console.error("Gagal memuat kosa kata:", e); 
    }
    document.getElementById('loadingState').style.display = 'none';
}

// Render Grid Kosa Kata
function renderItems(filtered = vocabulary) {
    const grid = document.getElementById('videoGrid');
    const empty = document.getElementById('emptyState');
    
    if (filtered.length === 0) {
        grid.innerHTML = '';
        empty.style.display = 'block';
        return;
    }
    
    empty.style.display = 'none';
    grid.innerHTML = filtered.map(item => `
        <div class="video-card" onclick="playVideo('${item.youtube_id}', '${item.judul}')">
            <div class="thumbnail-wrapper">
                <img src="${getThumb(item.youtube_id)}" class="video-thumbnail" alt="${item.judul}">
                <i class="bi bi-play-circle-fill play-icon"></i>
            </div>
            <div class="video-info">
                <span class="video-category">${item.kategori}</span>
                <h5 class="video-title">${item.judul}</h5>
                <p class="small text-muted mb-0">${item.deskripsi || 'Tidak ada deskripsi'}</p>
            </div>
        </div>
    `).join('');
}

// Menangani Submit Form Tambah Kosa Kata
document.getElementById('addWordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const youtubeURL = document.getElementById('youtubeURL').value;
    const videoId = getYTID(youtubeURL);
    
    if (!videoId) {
        alert("URL YouTube tidak valid!");
        return;
    }

    const payload = {
        judul: document.getElementById('wordName').value,
        kategori: document.getElementById('wordCategory').value,
        deskripsi: document.getElementById('wordDesc').value,
        url: youtubeURL,
        youtube_id: videoId,
        tipe: 'kosa_kata' // Menandai data sebagai kosa_kata
    };

    try {
        const response = await fetch('save_video.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        
        const result = await response.json();
        if (result.success) {
            alert("Kosa kata berhasil disimpan!");
            location.reload(); 
        } else {
            alert("Gagal menyimpan: " + result.message);
        }
    } catch (error) {
        console.error("Error saving data:", error);
    }
});

// Fungsi Putar Video
function playVideo(id, title) {
    document.getElementById('videoFrame').src = `https://www.youtube.com/embed/${id}?autoplay=1`;
    document.getElementById('playerTitle').innerText = title;
    new bootstrap.Modal(document.getElementById('videoModal')).show();
}

// Kelola Kosa Kata (Modal List)
function openManageWords() {
    const list = document.getElementById('manageList');
    list.innerHTML = vocabulary.map(item => `
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong class="d-block">${item.judul}</strong>
                <small class="text-muted">${item.kategori}</small>
            </div>
            <button onclick="hapusData(${item.id}, 'videos')" class="btn btn-danger btn-sm rounded-circle">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `).join('');
    new bootstrap.Modal(document.getElementById('manageModal')).show();
}

// Fungsi Hapus
async function hapusData(id, table) {
    if (!confirm("Hapus kosa kata ini secara permanen?")) return;
    try {
        const res = await fetch('delete.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({id, tabel: table})
        });
        const result = await res.json();
        if(result.success) { 
            alert("Data berhasil dihapus!"); 
            location.reload(); 
        }
    } catch (e) {
        console.error("Gagal menghapus:", e);
    }
}

// Pencarian dan Filter Kategori
document.getElementById('searchInput').addEventListener('input', (e) => {
    const val = e.target.value.toLowerCase();
    renderItems(vocabulary.filter(i => i.judul.toLowerCase().includes(val)));
});

document.querySelectorAll('.category-pill').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.category-pill').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const cat = this.dataset.category;
        renderItems(cat === 'Semua' ? vocabulary : vocabulary.filter(i => i.kategori === cat));
    });
});

// Bersihkan iframe saat modal ditutup
document.getElementById('videoModal').addEventListener('hidden.bs.modal', () => {
    document.getElementById('videoFrame').src = '';
});

// Inisialisasi
loadData();
</script>
</body>
</html>
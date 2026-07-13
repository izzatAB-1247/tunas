<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video BISINDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
       
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .category-pill {
            padding: 8px 18px;
            border-radius: 20px;
            background: #dbe7ff;
            color: #345;
            margin-right: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            border: none;
        }
        .category-pill:hover {
            background: #c5d7ff;
            transform: translateY(-2px);
        }
        .category-pill.active {
            background: #6c9bff;
            color: white;
        }
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .video-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }
        .video-thumbnail {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #e9ecef;
        }
        .video-info {
            padding: 15px;
        }
        .video-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 8px;
            color: #212529;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .video-category {
            display: inline-block;
            padding: 4px 10px;
            background: #e7f3ff;
            color: #0066cc;
            border-radius: 12px;
            font-size: 0.75rem;
            margin-bottom: 8px;
        }
        .video-description {
            font-size: 0.85rem;
            color: #6c757d;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .video-card button:hover {
    background-color: #ff0000 !important;
    transform: scale(1.1);
    transition: all 0.2s ease;
}
        .btn-add-video {
            background: #6c9bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .btn-add-video:hover {
            background: #5a8aee;
        }
        .modal-content {
            border-radius: 12px;
            border: none;
        }
        .modal-header {
            border-bottom: 1px solid #dee2e6;
            background: #f8f9fa;
        }
        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: white;
            opacity: 0;
            transition: opacity 0.3s;
            text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }
        .video-card:hover .play-icon {
            opacity: 1;
        }
        .thumbnail-wrapper {
            position: relative;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        .loading {
            text-align: center;
            padding: 40px;
        }
        .spinner-border {
            color: #6c9bff;
        }
    
    .btn-aesthetic {
        border: none;
        border-radius: 12px; /* Membuat sudut lebih bulat/modern */
        padding: 10px 20px;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Warna Biru Soft (Tambah Materi) */
    .btn-primary-soft {
        background-color: #e0e7ff;
        color: #4338ca;
    }

    .btn-primary-soft:hover {
        background-color: #4338ca;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(67, 56, 202, 0.3);
    }

    /* Warna Hijau Soft (Kelola Pelatihan) */
    .btn-success-soft {
        background-color: #dcfce7;
        color: #15803d;
    }

    .btn-success-soft:hover {
        background-color: #15803d;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(21, 128, 61, 0.3);
    }

    /* Efek Klik */
    .btn-aesthetic:active {
        transform: scale(0.95);
    }

    /* Ukuran Ikon */
    .btn-aesthetic i {
        font-size: 1.1rem;
    }
</style>
</head>
<body>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">📹 Video BISINDO</h2>
     
    </div>
    <div class="input-group mb-4">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
        <input id="searchInput" type="text" class="form-control border-start-0" placeholder="Cari video BISINDO...">
    </div>

    <div class="mb-4 d-flex flex-wrap">
        <button class="category-pill active" data-category="Semua">Semua</button>
        <button class="category-pill" data-category="Dasar">Dasar</button>
        <button class="category-pill" data-category="Percakapan">Percakapan</button>
        <button class="category-pill" data-category="Ekspresi">Ekspresi</button>
        <button class="category-pill" data-category="Isyarat Populer">Isyarat Populer</button>
    </div>

    <div id="loadingState" class="loading">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Memuat...</span>
        </div>
        <p class="mt-2">Memuat video...</p>
    </div>

    <div id="videoGrid" class="video-grid"></div>
    
    <div id="emptyState" class="empty-state" style="display: none;">
        <i class="bi bi-youtube"></i>
        <h4>Belum ada video</h4>
        <p>Klik tombol "Tambah Video YouTube" untuk menambahkan video pertama Anda</p>
    </div>
</div>

<!-- Modal Tambah Video -->
<div class="modal fade" id="addVideoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Video YouTube</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addVideoForm">
                    <div class="mb-3">
                        <label class="form-label">URL YouTube</label>
                        <input type="text" class="form-control" id="youtubeURL" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Video</label>
                        <input type="text" class="form-control" id="videoTitle" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" id="videoCategory" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Dasar">Dasar</option>
                            <option value="Percakapan">Percakapan</option>
                            <option value="Ekspresi">Ekspresi</option>
                            <option value="Isyarat Populer">Isyarat Populer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="videoDescription" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-add-video w-100">Tambah Video</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Putar Video -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="videoModalTitle">Pemutar Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                    <iframe id="videoFrame" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <div id="videoModalDescription" class="text-start w-100"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="manageContentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; padding: 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="manageTitle">Kelola Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="manageContentList" class="list-group">
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let videos = [];

// Fungsi untuk mengekstrak ID video YouTube dari URL
function getYouTubeID(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

// Fungsi untuk mendapatkan URL thumbnail YouTube
function getYouTubeThumbnail(videoId) {
    return `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;
}

// Fungsi untuk mendapatkan URL embed YouTube
function getYouTubeEmbed(videoId) {
    return `https://www.youtube.com/embed/${videoId}`;
}

// Muat video dari database
async function loadVideosFromDatabase() {
    try {
        document.getElementById('loadingState').style.display = 'block';
        document.getElementById('videoGrid').style.display = 'none';
        
        const response = await fetch('get_videos.php');
        const data = await response.json();
        
        if (data.success) {
            videos = data.videos;
            renderVideos();
        } else {
            alert('Error memuat video: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal memuat video dari database');
    }
}

// Render video grid
function renderVideos(filteredVideos = videos) {
    const videoGrid = document.getElementById('videoGrid');
    const emptyState = document.getElementById('emptyState');
    const loadingState = document.getElementById('loadingState');
    
    loadingState.style.display = 'none';
    
    if (filteredVideos.length === 0) {
        videoGrid.style.display = 'none';
        emptyState.style.display = 'block';
        return;
    }
    
    videoGrid.style.display = 'grid';
    emptyState.style.display = 'none';
    
   videoGrid.innerHTML = filteredVideos.map(video => `
    <div class="video-card" data-video-id="${video.id}" data-category="${video.kategori}" style="position: relative;">
        
       

        <div class="thumbnail-wrapper">
            <img src="${getYouTubeThumbnail(video.youtube_id)}" class="video-thumbnail" alt="${video.judul}" onerror="this.src='https://via.placeholder.com/300x180?text=Video+Tidak+Tersedia'">
            <i class="bi bi-play-circle-fill play-icon"></i>
        </div>
        <div class="video-info">
            <span class="video-category">${video.kategori}</span>
            <h3 class="video-title">${video.judul}</h3>
            <p class="video-description">${video.deskripsi || 'Tidak ada deskripsi'}</p>
        </div>
    </div>
`).join('');
    
    document.querySelectorAll('.video-card').forEach(card => {
        card.addEventListener('click', function() {
           const videoId = this.dataset.videoId;
           const video = videos.find(v => v.id == videoId);
            playVideo(video);
        });
    });
}

// Play video in modal
function playVideo(video) {
    const videoFrame = document.getElementById('videoFrame');
    const videoModalTitle = document.getElementById('videoModalTitle');
    const videoModalDescription = document.getElementById('videoModalDescription');
    
    videoFrame.src = getYouTubeEmbed(video.youtube_id);
    videoModalTitle.textContent = video.judul;
    videoModalDescription.innerHTML = `
        <span class="badge bg-primary">${video.kategori}</span>
        <p class="mt-2 mb-0">${video.deskripsi || 'Tidak ada deskripsi'}</p>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();
}

// Stop video when modal closes
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('videoFrame').src = '';
});

// Add video form
document.getElementById('addVideoForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const youtubeURL = document.getElementById('youtubeURL').value;
    const title = document.getElementById('videoTitle').value;
    const category = document.getElementById('videoCategory').value;
    const description = document.getElementById('videoDescription').value;
    
    const videoId = getYouTubeID(youtubeURL);
    
    if (!videoId) {
        alert('URL YouTube tidak valid! Pastikan format URL benar.');
        return;
    }
    
    try {
        const response = await fetch('save_video.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                url: youtubeURL,
                judul: title,
                kategori: category,
                deskripsi: description,
                youtube_id: videoId
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Video berhasil ditambahkan!');
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('addVideoModal')).hide();
            loadVideosFromDatabase();
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal menambahkan video');
    }
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    const activeCategory = document.querySelector('.category-pill.active').dataset.category;
    
    let filtered = videos;
    
    if (activeCategory !== 'Semua') {
        filtered = filtered.filter(v => v.kategori === activeCategory);
    }
    
    if (keyword) {
        filtered = filtered.filter(v => 
            v.judul.toLowerCase().includes(keyword) || 
            (v.deskripsi && v.deskripsi.toLowerCase().includes(keyword))
        );
    }
    
    renderVideos(filtered);
});

// Category filter
document.querySelectorAll('.category-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.category-pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        
        const category = this.dataset.category;
        const keyword = document.getElementById('searchInput').value.toLowerCase();
        
        let filtered = videos;
        
        if (category !== 'Semua') {
            filtered = filtered.filter(v => v.kategori === category);
        }
        
        if (keyword) {
            filtered = filtered.filter(v => 
                v.judul.toLowerCase().includes(keyword) || 
                (v.deskripsi && v.deskripsi.toLowerCase().includes(keyword))
            );
        }
        
        renderVideos(filtered);
    });
});
async function hapusData(id, namaTabel) {
    if (!confirm("Yakin ingin menghapus?")) return;

    try {
        const response = await fetch('delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, tabel: namaTabel })
        });

        // Jika server mengirim error 404 atau 500
        if (!response.ok) {
            const errorText = await response.text();
            console.error("Server Error:", errorText);
            alert("Server Error: " + response.status);
            return;
        }

        const res = await response.json();
        if (res.success) {
            alert("Terhapus!");
            location.reload();
        } else {
            alert("Gagal: " + res.message);
        }
    } catch (error) {
        console.error("Fetch Error:", error);
        alert("Gagal menghubungi server. Pastikan file delete.php ada.");
    }
}
function openManageVideos() {
    document.getElementById('manageTitle').innerText = "Kelola Semua Video";
    const list = document.getElementById('manageContentList');
    
    // 'videos' adalah variabel array tempat Anda menyimpan data dari fetch sebelumnya
    list.innerHTML = videos.map(v => `
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="${getYouTubeThumbnail(v.youtube_id)}" style="width: 80px; border-radius: 5px; margin-right: 15px;">
                <div>
                    <div class="fw-bold">${v.judul}</div>
                    <small class="text-muted">${v.kategori}</small>
                </div>
            </div>
            <button onclick="hapusData(${v.id}, 'videos')" class="btn btn-danger btn-sm" style="border-radius: 50%; width: 35px; height: 35px;">🗑️</button>
        </div>
    `).join('');
    
    new bootstrap.Modal(document.getElementById('manageContentModal')).show();
}


// Load videos on page load
loadVideosFromDatabase();
</script>

</body>
</html>
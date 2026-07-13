<div class="clay-animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold" style="color:var(--color-clay-text);"><span class="material-symbols-outlined" style="color:var(--color-clay-primary);vertical-align:middle;font-variation-settings:'FILL' 1;">videocam</span> Video BISINDO</h2>
        <div class="d-flex gap-2">
            <button class="clay-btn clay-btn-primary" data-bs-toggle="modal" data-bs-target="#addVideoModal">
                <span class="material-symbols-outlined" style="font-size:20px;">add_circle</span> Tambah Video
            </button>
            <button class="clay-btn clay-btn-soft" onclick="openManageVideos()">
                <span class="material-symbols-outlined" style="font-size:20px;">settings</span> Kelola
            </button>
        </div>
    </div>

    <div class="clay-search mb-4">
        <div style="display:flex;align-items:center;gap:12px;">
            <span class="material-symbols-outlined" style="font-size:20px;color:var(--color-clay-text-muted);">search</span>
            <input id="searchInput" type="text" style="border:none;background:none;width:100%;outline:none;font-size:14px;" placeholder="Cari video BISINDO...">
        </div>
    </div>

    <div class="mb-4 d-flex flex-wrap">
        <button class="clay-pill active" data-category="Semua">Semua</button>
        <button class="clay-pill" data-category="Dasar">Dasar</button>
        <button class="clay-pill" data-category="Percakapan">Percakapan</button>
        <button class="clay-pill" data-category="Ekspresi">Ekspresi</button>
        <button class="clay-pill" data-category="Isyarat Populer">Isyarat Populer</button>
    </div>

    <div id="loadingState" class="text-center py-5">
        <div class="spinner-border" role="status"></div>
        <p class="mt-2" style="color:var(--color-clay-text-muted);">Memuat video...</p>
    </div>
    <div id="videoGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;margin-top:20px;"></div>
    <div id="emptyState" class="text-center py-5" style="display:none;">
        <span class="material-symbols-outlined" style="font-size:4rem;color:var(--color-clay-text-muted);">smart_display</span>
        <h4 class="mt-3" style="color:var(--color-clay-text-muted);">Belum ada video</h4>
    </div>
</div>

@include('guru._modal_video')
@include('guru._modal_manage')

<script>
let videos = [];

function getYouTubeID(url) {
    const m = url.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/);
    return (m && m[2].length === 11) ? m[2] : null;
}

async function loadVideos() {
    try {
        const res = await fetch('{{ route("videos.index") }}?tipe=bisindo');
        const data = await res.json();
        if (data.success) { videos = data.videos; renderVideos(); }
    } catch(e) { console.error(e); }
    document.getElementById('loadingState').style.display = 'none';
}

function renderVideos(filtered = videos) {
    const grid = document.getElementById('videoGrid');
    const empty = document.getElementById('emptyState');
    if (filtered.length === 0) { grid.innerHTML = ''; empty.style.display = 'block'; return; }
    empty.style.display = 'none';
    grid.innerHTML = filtered.map(v => `
        <div class="clay-video-card" onclick="playVideo('${v.youtube_id}', '${v.judul}', '${v.deskripsi || ''}', '${v.kategori}')">
            <div class="thumbnail-wrapper">
                <img src="https://img.youtube.com/vi/${v.youtube_id}/maxresdefault.jpg" alt="${v.judul}">
                <span class="material-symbols-outlined play-overlay" style="font-size:3.5rem;">play_circle</span>
            </div>
            <div class="video-info">
                <span class="clay-badge clay-badge-soft">${v.kategori}</span>
                <h3 class="video-title" style="font-weight:600;margin-top:10px;color:var(--color-clay-text);">${v.judul}</h3>
            </div>
        </div>
    `).join('');
}

function playVideo(id, title, desc, cat) {
    const iframe = document.getElementById('videoFrame');
    iframe.src = `https://www.youtube.com/embed/${id}?autoplay=1`;
    document.getElementById('videoModalTitle').textContent = title;
    document.getElementById('videoDesc').innerHTML = `<span class="clay-badge clay-badge-primary">${cat}</span><p class="mt-2">${desc}</p>`;
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();
    document.getElementById('videoModal').addEventListener('shown.bs.modal', function onShown() {
        this.removeEventListener('shown.bs.modal', onShown);
        requestAnimationFrame(() => {
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.webkitRequestFullscreen) {
                iframe.webkitRequestFullscreen();
            } else if (iframe.msRequestFullscreen) {
                iframe.msRequestFullscreen();
            }
        });
    });
}

document.getElementById('addVideoForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const url = document.getElementById('youtubeURL').value;
    const vid = getYouTubeID(url);
    if (!vid) { alert('URL YouTube tidak valid!'); return; }
    const res = await fetch('{{ route("guru.videos.store") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({
            url, youtube_id: vid, tipe: 'bisindo',
            judul: document.getElementById('videoTitle').value,
            kategori: document.getElementById('videoCategory').value,
            deskripsi: document.getElementById('videoDescription').value,
        })
    });
    const data = await res.json();
    if (data.success) { alert('Video berhasil ditambahkan!'); this.reset(); bootstrap.Modal.getInstance(document.getElementById('addVideoModal')).hide(); loadVideos(); }
    else { alert('Error: ' + data.message); }
});

document.getElementById('searchInput').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    const cat = document.querySelector('.clay-pill.active').dataset.category;
    let filtered = videos;
    if (cat !== 'Semua') filtered = filtered.filter(v => v.kategori === cat);
    if (keyword) filtered = filtered.filter(v => v.judul.toLowerCase().includes(keyword) || (v.deskripsi && v.deskripsi.toLowerCase().includes(keyword)));
    renderVideos(filtered);
});

document.querySelectorAll('.clay-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.clay-pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('searchInput').dispatchEvent(new Event('input'));
    });
});

document.getElementById('videoModal').addEventListener('hidden.bs.modal', () => document.getElementById('videoFrame').src = '');

async function hapusData(id, tabel) {
    if (!confirm('Yakin ingin menghapus?')) return;
    const res = await fetch('{{ route("guru.delete") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ id, tabel })
    });
    const data = await res.json();
    if (data.success) { alert('Terhapus!'); location.reload(); }
    else alert('Gagal: ' + data.message);
}

function openManageVideos() {
    const list = document.getElementById('manageContentList');
    list.innerHTML = videos.map(v => `
        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center gap-3">
                <img src="https://img.youtube.com/vi/${v.youtube_id}/default.jpg" style="width:80px;border-radius:12px;">
                <div><div class="fw-bold" style="color:var(--color-clay-text);">${v.judul}</div><small style="color:var(--color-clay-text-muted);">${v.kategori}</small></div>
            </div>
            <button onclick="hapusData(${v.id}, 'videos')" class="clay-btn clay-btn-danger" style="padding:8px 14px;"><span class="material-symbols-outlined" style="font-size:20px;">delete</span></button>
        </div>
    `).join('');
    new bootstrap.Modal(document.getElementById('manageContentModal')).show();
}

loadVideos();
</script>

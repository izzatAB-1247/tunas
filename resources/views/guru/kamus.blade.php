<div class="clay-animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold" style="color:var(--color-clay-text);"><span class="material-symbols-outlined" style="color:var(--color-clay-primary);vertical-align:middle;font-variation-settings:'FILL' 1;">book</span> Kosa Kata BISINDO</h2>
        <div class="d-flex gap-2">
            <button class="clay-btn clay-btn-primary" data-bs-toggle="modal" data-bs-target="#addWordModal">
                <span class="material-symbols-outlined" style="font-size:20px;">add_circle</span> Tambah Kata
            </button>
            <button class="clay-btn clay-btn-soft" onclick="openManageWords()">
                <span class="material-symbols-outlined" style="font-size:20px;">edit</span> Kelola
            </button>
        </div>
    </div>

    <div class="clay-search mb-4">
        <div style="display:flex;align-items:center;gap:12px;">
            <span class="material-symbols-outlined" style="font-size:20px;color:var(--color-clay-text-muted);">search</span>
            <input id="searchInput" type="text" style="border:none;background:none;width:100%;outline:none;font-size:14px;" placeholder="Cari kosa kata...">
        </div>
    </div>

    <div class="mb-4 d-flex flex-wrap">
        <button class="clay-pill active" data-category="Semua">Semua</button>
        <button class="clay-pill" data-category="Keluarga">Keluarga</button>
        <button class="clay-pill" data-category="Kata Kerja">Kata Kerja</button>
        <button class="clay-pill" data-category="Benda">Benda</button>
        <button class="clay-pill" data-category="Waktu">Waktu</button>
        <button class="clay-pill" data-category="Sifat">Sifat</button>
    </div>

    <div id="loadingState" class="text-center py-5">
        <div class="spinner-border" role="status"></div>
        <p class="mt-2" style="color:var(--color-clay-text-muted);">Memuat kosa kata...</p>
    </div>
    <div id="videoGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;"></div>
    <div id="emptyState" class="text-center py-5" style="display:none;">
        <span class="material-symbols-outlined" style="font-size:4rem;color:var(--color-clay-text-muted);">book</span>
        <h4 class="mt-3" style="color:var(--color-clay-text-muted);">Kosa kata tidak ditemukan</h4>
    </div>
</div>

<div class="modal fade clay-modal" id="addWordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addWordForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Kosa Kata Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Nama Kosa Kata</label>
                        <input type="text" class="clay-input" id="wordName" placeholder="Contoh: Terima Kasih" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">URL YouTube</label>
                        <input type="text" class="clay-input" id="youtubeURL" placeholder="https://youtube.com/..." required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Kategori</label>
                        <select class="clay-select" id="wordCategory" required>
                            <option value="Keluarga">Keluarga</option>
                            <option value="Kata Kerja">Kata Kerja</option>
                            <option value="Benda">Benda</option>
                            <option value="Waktu">Waktu</option>
                            <option value="Sifat">Sifat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Penjelasan</label>
                        <textarea class="clay-input" id="wordDesc" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="clay-btn clay-btn-primary w-100 justify-content-center py-2">Simpan Kosa Kata</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('guru._modal_manage')

<div class="modal fade clay-modal" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered">
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

<script>
let vocabulary = [];

const getYTID = (url) => { const m = url.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/); return (m && m[2].length === 11) ? m[2] : null; };

async function loadData() {
    try {
        const res = await fetch('{{ route("kosa-kata.index") }}');
        const data = await res.json();
        if (data.success) { vocabulary = data.videos; renderItems(); }
    } catch(e) { console.error(e); }
    document.getElementById('loadingState').style.display = 'none';
}

function renderItems(filtered = vocabulary) {
    const grid = document.getElementById('videoGrid');
    const empty = document.getElementById('emptyState');
    if (filtered.length === 0) { grid.innerHTML = ''; empty.style.display = 'block'; return; }
    empty.style.display = 'none';
    grid.innerHTML = filtered.map(item => `
        <div class="clay-video-card" onclick="playVideo('${item.youtube_id}', '${item.judul}')">
            <div class="thumbnail-wrapper" style="height:170px;">
                <img src="https://img.youtube.com/vi/${item.youtube_id}/mqdefault.jpg" alt="${item.judul}">
                <span class="material-symbols-outlined play-overlay" style="font-size:3rem;">play_circle</span>
            </div>
            <div class="video-info">
                <span class="clay-badge clay-badge-soft">${item.kategori}</span>
                <h5 class="video-title" style="font-weight:600;margin-top:10px;color:var(--color-clay-text);">${item.judul}</h5>
                <p style="font-size:0.85rem;color:var(--color-clay-text-muted);margin:4px 0 0;">${item.deskripsi || ''}</p>
            </div>
        </div>
    `).join('');
}

document.getElementById('addWordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const url = document.getElementById('youtubeURL').value;
    const vid = getYTID(url);
    if (!vid) { alert('URL YouTube tidak valid!'); return; }
    const res = await fetch('{{ route("guru.videos.store") }}', {
        method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ judul: document.getElementById('wordName').value, kategori: document.getElementById('wordCategory').value, deskripsi: document.getElementById('wordDesc').value, url, youtube_id: vid, tipe: 'kosa_kata' })
    });
    const result = await res.json();
    if (result.success) { alert('Kosa kata berhasil disimpan!'); location.reload(); }
    else alert('Gagal: ' + result.message);
});

function playVideo(id, title) {
    const iframe = document.getElementById('videoFrame');
    iframe.src = `https://www.youtube.com/embed/${id}?autoplay=1`;
    document.getElementById('playerTitle').textContent = title;
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

function openManageWords() {
    const list = document.getElementById('manageContentList');
    list.innerHTML = vocabulary.map(item => `
        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
            <div><strong class="d-block" style="color:var(--color-clay-text);">${item.judul}</strong><small style="color:var(--color-clay-text-muted);">${item.kategori}</small></div>
            <button onclick="hapusData(${item.id}, 'videos')" class="clay-btn clay-btn-danger" style="padding:8px 14px;"><span class="material-symbols-outlined" style="font-size:20px;">delete</span></button>
        </div>
    `).join('');
    new bootstrap.Modal(document.getElementById('manageContentModal')).show();
}

async function hapusData(id, tabel) {
    if (!confirm('Hapus kosa kata ini?')) return;
    const res = await fetch('{{ route("guru.delete") }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ id, tabel }) });
    const result = await res.json();
    if (result.success) { alert('Terhapus!'); location.reload(); }
}

document.getElementById('searchInput').addEventListener('input', (e) => {
    const val = e.target.value.toLowerCase();
    renderItems(vocabulary.filter(i => i.judul.toLowerCase().includes(val)));
});

document.querySelectorAll('.clay-pill').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.clay-pill').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const cat = this.dataset.category;
        renderItems(cat === 'Semua' ? vocabulary : vocabulary.filter(i => i.kategori === cat));
    });
});

document.getElementById('videoModal').addEventListener('hidden.bs.modal', () => document.getElementById('videoFrame').src = '');

loadData();
</script>

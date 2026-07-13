<div class="clay-animate-fade-in">
    <h2 class="fw-bold mb-4" style="color:var(--color-clay-text);">
        @if($tipeView === 'pelatihan') <span class="material-symbols-outlined" style="color:var(--color-clay-primary);vertical-align:middle;font-variation-settings:'FILL' 1;">workspace_premium</span> Pelatihan Persiapan Kerja
        @elseif($tipeView === 'bisindo') <span class="material-symbols-outlined" style="color:var(--color-clay-primary);vertical-align:middle;font-variation-settings:'FILL' 1;">videocam</span> Video BISINDO
        @elseif($tipeView === 'kosa_kata') <span class="material-symbols-outlined" style="color:var(--color-clay-primary);vertical-align:middle;font-variation-settings:'FILL' 1;">book</span> Kosa Kata BISINDO
        @endif
    </h2>

    <div class="mb-4 d-flex flex-wrap">
        <button class="clay-pill active" data-category="Semua">Semua</button>
        @if($tipeView === 'pelatihan')
            <button class="clay-pill" data-category="Curriculum Vitae">CV</button>
            <button class="clay-pill" data-category="Interview">Interview</button>
            <button class="clay-pill" data-category="Portofolio">Portofolio</button>
            <button class="clay-pill" data-category="Soft Skills">Soft Skills</button>
            <button class="clay-pill" data-category="Etika Kerja">Etika Kerja</button>
        @elseif($tipeView === 'bisindo')
            <button class="clay-pill" data-category="Dasar">Dasar</button>
            <button class="clay-pill" data-category="Percakapan">Percakapan</button>
            <button class="clay-pill" data-category="Ekspresi">Ekspresi</button>
        @elseif($tipeView === 'kosa_kata')
            <button class="clay-pill" data-category="Keluarga">Keluarga</button>
            <button class="clay-pill" data-category="Kata Kerja">Kata Kerja</button>
            <button class="clay-pill" data-category="Benda">Benda</button>
            <button class="clay-pill" data-category="Waktu">Waktu</button>
            <button class="clay-pill" data-category="Sifat">Sifat</button>
        @endif
    </div>

    <div id="videoGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;">
        <div class="text-center py-5 w-100"><div class="spinner-border"></div></div>
    </div>
</div>

<div class="modal fade clay-modal" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-dark text-white">
                <h5 class="modal-title" id="videoModalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 bg-dark">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" frameborder="0" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let videos = [];

async function loadVideos() {
    try {
        const res = await fetch('{{ route("videos.index") }}?tipe={{ $tipeView }}');
        const data = await res.json();
        if (data.success) { videos = data.videos; renderVideos(); }
    } catch(e) { console.error(e); }
}

function renderVideos(filtered) {
    const items = filtered || videos;
    const grid = document.getElementById('videoGrid');
    if (!items.length) { grid.innerHTML = '<div class="text-center py-5 w-100"><h4 style="color:var(--color-clay-text-muted);">Belum ada materi</h4></div>'; return; }
    grid.innerHTML = items.map(v => `
        <div class="clay-video-card" onclick="openVideo('${v.youtube_id}', '${v.judul}')">
            <div class="thumbnail-wrapper">
                <img src="https://img.youtube.com/vi/${v.youtube_id}/maxresdefault.jpg" alt="${v.judul}" onerror="this.src='https://via.placeholder.com/300x180?text=No+Video'">
                <span class="material-symbols-outlined play-overlay" style="font-size:3.5rem;">play_circle</span>
            </div>
            <div class="video-info">
                <span class="clay-badge clay-badge-soft">${v.kategori}</span>
                <h3 class="video-title" style="font-weight:600;margin-top:10px;color:var(--color-clay-text);">${v.judul}</h3>
            </div>
        </div>
    `).join('');
}

function openVideo(id, title) {
    const iframe = document.getElementById('videoFrame');
    iframe.src = `https://www.youtube.com/embed/${id}?autoplay=1`;
    document.getElementById('videoModalTitle').textContent = title;

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

document.querySelectorAll('.clay-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.clay-pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        const cat = this.dataset.category;
        if (cat === 'Semua') renderVideos(videos);
        else renderVideos(videos.filter(v => v.kategori === cat));
    });
});

document.getElementById('videoModal').addEventListener('hidden.bs.modal', () => document.getElementById('videoFrame').src = '');

loadVideos();
</script>

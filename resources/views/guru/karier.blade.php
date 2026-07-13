<div class="clay-animate-fade-in">
    <div class="text-center mb-5">
        <h1 style="font-weight:800;background:linear-gradient(135deg,var(--color-clay-primary),#ec4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">🌟 Profil Karier Inspiratif</h1>
        <p style="color:var(--color-clay-text-muted);">Kisah Sukses Individu Tunarungu yang Menginspirasi Dunia</p>
    </div>

    <div class="d-flex justify-content-center gap-3 mb-5 flex-wrap">
        <button class="clay-btn clay-btn-primary" data-bs-toggle="modal" data-bs-target="#modalKarir">
            <span class="material-symbols-outlined" style="font-size:20px;">add</span> Tambah Profil
        </button>
        <button class="clay-btn clay-btn-soft" onclick="openManageKarir()">
            <span class="material-symbols-outlined" style="font-size:20px;">settings</span> Kelola
        </button>
    </div>

    <div id="profileGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:28px;">
        <div class="text-center w-100 py-5" id="loadingState">
            <div class="spinner-border" role="status"></div>
            <p class="mt-2" style="color:var(--color-clay-text-muted);">Memuat inspirasi...</p>
        </div>
    </div>
</div>

<div class="modal fade clay-modal" id="modalKarir" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold">Bagikan Kisah Baru</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKarir" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Nama Lengkap</label>
                        <input type="text" name="nama" class="clay-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Jabatan/Bidang</label>
                        <input type="text" name="jabatan" class="clay-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Deskripsi</label>
                        <textarea name="deskripsi" class="clay-input" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Pencapaian (Pisahkan koma)</label>
                        <input type="text" name="pencapaian" class="clay-input" required>
                    </div>
                    <div class="mb-4">
                        <label class="fw-semibold" style="font-size:13px;">Foto Profil</label>
                        <input type="file" name="foto" class="clay-input" accept="image/*" required>
                    </div>
                    <button type="submit" class="clay-btn clay-btn-primary w-100 justify-content-center py-3">Terbitkan Profil <i class="bi bi-send ms-2"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade clay-modal" id="manageContentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-bold m-0">Kelola Data Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="manageContentList" class="d-flex flex-column gap-2"></div>
            </div>
        </div>
    </div>
</div>

<script>
async function loadProfiles() {
    const grid = document.getElementById('profileGrid');
    try {
        const res = await fetch('{{ route("karir.index") }}');
        const result = await res.json();
        if (result.success && result.data.length > 0) {
            grid.innerHTML = result.data.map(p => {
                const items = p.pencapaian.split(',').map(i => i.trim()).filter(i => i);
                return `<div class="clay-profile-card">
                    <img src="{{ asset('storage') }}/${p.foto}" alt="${p.nama}" class="profile-image">
                    <div class="profile-content">
                        <span class="clay-badge clay-badge-soft">${p.jabatan}</span>
                        <h3 class="profile-name" style="font-weight:700;margin:12px 0 8px;font-size:1.3rem;">${p.nama}</h3>
                        <p style="color:var(--color-clay-text-muted);font-size:0.95rem;line-height:1.6;margin-bottom:16px;">${p.deskripsi}</p>
                        ${items.map(i => `<div style="background:rgba(163,155,145,0.1);padding:8px 14px;border-radius:12px;font-size:0.85rem;margin-bottom:8px;display:flex;align-items:center;gap:8px;"><i class="bi bi-check-circle-fill" style="color:var(--color-clay-accent);"></i> ${i}</div>`).join('')}
                    </div>
                </div>`;
            }).join('');
        } else {
            grid.innerHTML = '<div class="text-center py-5 w-100"><i class="bi bi-inbox fs-1" style="color:var(--color-clay-text-muted);"></i><p class="mt-2" style="color:var(--color-clay-text-muted);">Belum ada data profil.</p></div>';
        }
    } catch(e) { grid.innerHTML = '<p class="text-danger text-center">Gagal memuat data.</p>'; }
}

document.getElementById('formKarir').onsubmit = async (e) => {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    btn.disabled = true; btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
    try {
        const res = await fetch('{{ route("guru.karir.store") }}', { method: 'POST', body: new FormData(e.target), headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
        const result = await res.json();
        if (result.success) { alert('Profil berhasil ditambahkan!'); location.reload(); }
        else alert('Gagal: ' + result.message);
    } catch(e) { alert('Terjadi kesalahan.'); }
    finally { btn.disabled = false; btn.innerHTML = 'Terbitkan Profil <i class="bi bi-send ms-2"></i>'; }
};

async function openManageKarir() {
    const list = document.getElementById('manageContentList');
    list.innerHTML = '<div class="text-center p-4"><div class="spinner-border"></div></div>';
    const res = await fetch('{{ route("karir.index") }}');
    const result = await res.json();
    if (result.success) {
        list.innerHTML = result.data.map(p => `
            <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('storage') }}/${p.foto}" style="width:50px;height:50px;border-radius:50%;object-fit:cover;box-shadow:var(--shadow-clay-sm);">
                    <div><div class="fw-bold" style="color:var(--color-clay-text);">${p.nama}</div><small style="color:var(--color-clay-text-muted);">${p.jabatan}</small></div>
                </div>
                <button onclick="hapusData(${p.id}, 'karir')" class="clay-btn clay-btn-danger" style="padding:8px 14px;"><i class="bi bi-trash3"></i></button>
            </div>
        `).join('');
    }
    new bootstrap.Modal(document.getElementById('manageContentModal')).show();
}

async function hapusData(id, tabel) {
    if (!confirm('Hapus profil ini?')) return;
    try {
        const res = await fetch('{{ route("guru.delete") }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ id, tabel }) });
        const data = await res.json();
        if (data.success) location.reload();
        else alert('Gagal.');
    } catch(e) { alert('Kesalahan.'); }
}

window.onload = loadProfiles;
</script>

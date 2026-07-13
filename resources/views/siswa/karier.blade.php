<div class="clay-animate-fade-in">
    <h2 class="fw-bold mb-4" style="color:var(--color-clay-text);"><i class="bi bi-briefcase-fill" style="color:var(--color-clay-primary);"></i> Profil Karier Inspiratif</h2>
    <div class="row" id="karirGrid">
        <div class="text-center py-5"><div class="clay-spinner spinner-border"></div></div>
    </div>
</div>

<script>
fetch('{{ route("karir.index") }}').then(r => r.json()).then(result => {
    const grid = document.getElementById('karirGrid');
    if (result.success && result.data.length > 0) {
        grid.innerHTML = result.data.map(p => `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="clay-profile-card h-100">
                    <img src="/storage/${p.foto}" class="profile-image" style="height:250px;" alt="${p.nama}">
                    <div class="profile-content">
                        <span class="clay-badge clay-badge-soft">${p.jabatan}</span>
                        <h5 class="fw-bold mt-2" style="color:var(--color-clay-text);">${p.nama}</h5>
                        <p style="color:var(--color-clay-text-muted);font-size:0.95rem;">${p.deskripsi}</p>
                    </div>
                </div>
            </div>
        `).join('');
    } else {
        grid.innerHTML = '<div class="col-12 text-center py-5"><h4 style="color:var(--color-clay-text-muted);">Belum ada profil karier</h4></div>';
    }
});
</script>

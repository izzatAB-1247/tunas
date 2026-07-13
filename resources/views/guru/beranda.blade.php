{{-- Welcome Hero --}}
<section class="mb-8">
    <div class="clay-card overflow-hidden relative p-6 bg-gradient-to-br from-primary to-primary-container text-white">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h2 class="text-[28px] font-bold mb-2">Halo, {{ $user->nama_lengkap }}! 👋</h2>
            <p class="font-body-md text-white/80 max-w-[80%]">Semoga hari mengajar Anda penuh semangat dan inspirasi! 🌈</p>
        </div>
        <div class="absolute bottom-4 right-6 opacity-20 pointer-events-none">
            <span class="material-symbols-outlined text-[80px]">school</span>
        </div>
    </div>
</section>

{{-- Profile Card --}}
<section class="mb-8">
    <div class="clay-card p-5 flex items-center gap-4">
        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/user.png') }}"
             class="w-16 h-16 rounded-full object-cover bg-surface-container-high shadow-[8px_8px_16px_rgba(166,155,143,0.2)]">
        <div class="flex-1">
            <h4 class="font-headline-md text-primary">{{ $user->nama_lengkap }}</h4>
            <p class="font-label-md text-on-surface-variant">{{ $user->email }}</p>
            <button class="mt-2 clay-button bg-secondary-container text-on-secondary-container font-label-md px-4 py-2 rounded-full flex items-center gap-2 text-sm active:scale-95 transition-transform" data-bs-toggle="modal" data-bs-target="#editProfil">
                <span class="material-symbols-outlined" style="font-size:16px;">edit</span> Edit Profil
            </button>
        </div>
    </div>
</section>

{{-- Stats Grid --}}
<section class="grid grid-cols-2 gap-4 mb-8">
    <div class="clay-card p-5 flex flex-col items-center text-center">
        <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed mb-3 flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">door_open</span>
        </div>
        <p class="font-display-lg text-[24px] text-primary" id="totalSiswaCount">{{ $totalLoginSiswa }}</p>
        <p class="font-label-md text-on-surface-variant">Login Siswa</p>
        <p class="text-xs text-on-surface-variant mt-1">Siswa bimbingan Anda</p>
    </div>
    <div class="clay-card p-5 flex flex-col items-center text-center">
        <div class="w-12 h-12 rounded-2xl bg-secondary-fixed mb-3 flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-on-secondary-fixed-variant" style="font-variation-settings: 'FILL' 1;">bar_chart</span>
        </div>
        <p class="font-display-lg text-[24px] text-primary">{{ number_format($rataNilai, 1) }}</p>
        <p class="font-label-md text-on-surface-variant">Rata-rata Nilai</p>
        <p class="text-xs text-on-surface-variant mt-1">Nilai akademik terbaru</p>
    </div>
</section>

{{-- Progress Bars --}}
<section class="mb-8">
    <div class="clay-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-headline-md text-on-surface">Capaian Kelas</h3>
        </div>
        <div class="space-y-5">
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">Kehadiran</span>
                    <span class="font-label-md text-primary">85%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-secondary-container to-secondary w-[85%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">Nilai Kuis</span>
                    <span class="font-label-md text-primary">72%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-primary-container to-primary w-[72%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">Materi Selesai</span>
                    <span class="font-label-md text-primary">60%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-tertiary-container to-tertiary w-[60%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">BISINDO Dasar</span>
                    <span class="font-label-md text-primary">90%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-secondary-container to-secondary w-[90%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Chart --}}
<section class="mb-8">
    <div class="clay-card p-6">
        <h3 class="font-headline-md text-on-surface mb-4">Statistik Kehadiran Siswa</h3>
        <canvas id="cuteChart" height="130"></canvas>
    </div>
</section>

{{-- Alert Success --}}
@if (session('success'))
<div class="mb-6 p-4 bg-tertiary-container/10 text-tertiary rounded-2xl border border-tertiary/20 font-label-md flex items-center gap-2">
    <span class="material-symbols-outlined" style="font-size:20px;">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Edit Profile Modal --}}
<div class="modal fade" id="editProfil" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content clay-card p-6 rounded-xl">
            <div class="modal-header border-b border-outline-variant/30 pb-4 mb-4">
                <h5 class="font-headline-md text-primary">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('guru.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Nama Depan</label>
                    <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                        <input type="text" name="nama_depan" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" value="{{ $user->nama_depan }}" required>
                    </div>

                    <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Nama Belakang</label>
                    <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                        <input type="text" name="nama_belakang" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" value="{{ $user->nama_belakang }}" required>
                    </div>

                    <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Email</label>
                    <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                        <input type="email" name="email" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" value="{{ $user->email }}" required>
                    </div>

                    <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Password Baru (kosongkan jika tidak diubah)</label>
                    <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                        <input type="password" name="password" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" placeholder="Min. 8 karakter">
                    </div>

                    <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Konfirmasi Password Baru</label>
                    <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                        <input type="password" name="password_confirmation" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" placeholder="Ulangi password baru">
                    </div>

                    <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Foto Profil (Opsional)</label>
                    <div class="clay-inset rounded-lg px-4 py-3 mb-4">
                        <input type="file" name="foto" class="bg-transparent border-none focus:ring-0 w-full" accept="image/*">
                    </div>

                    <button type="submit" class="clay-button w-full py-4 rounded-lg text-white font-bold flex items-center justify-center gap-2 active:scale-95 transition-transform" style="background: linear-gradient(135deg, #fe8e2e 0%, #944a00 100%);">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
            borderColor: '#5b6fc6',
            backgroundColor: '#dbe6ff',
            fill: true
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { ticks: { color: '#777' } }, x: { ticks: { color: '#777' } } }
    }
});
</script>

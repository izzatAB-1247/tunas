{{-- Alert Success --}}
@if (session('success'))
<div class="mb-6 p-4 bg-tertiary-container/10 text-tertiary rounded-2xl border border-tertiary/20 font-label-md flex items-center gap-2">
    <span class="material-symbols-outlined" style="font-size:20px;">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Profile Card --}}
<section class="mb-8">
    <div class="clay-card p-5 flex items-center gap-4">
        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/user.png') }}"
             class="w-16 h-16 rounded-full object-cover bg-surface-container-high shadow-[8px_8px_16px_rgba(166,155,143,0.2)]">
        <div class="flex-1">
            <h4 class="font-headline-md text-primary">{{ Auth::user()->nama_lengkap }}</h4>
            <p class="font-label-md text-on-surface-variant">{{ Auth::user()->email }}</p>
            <button class="mt-2 clay-button bg-secondary-container text-on-secondary-container font-label-md px-4 py-2 rounded-full flex items-center gap-2 text-sm active:scale-95 transition-transform" data-bs-toggle="modal" data-bs-target="#editProfil">
                <span class="material-symbols-outlined" style="font-size:16px;">edit</span> Edit Profil
            </button>
        </div>
    </div>
</section>

{{-- Welcome Hero --}}
<section class="mb-8">
    <div class="clay-card overflow-hidden relative p-6 bg-gradient-to-br from-primary to-primary-container text-white">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h2 class="text-[28px] font-bold mb-2">Halo, {{ Auth::user()->nama_lengkap }}! 👋</h2>
            <p class="font-body-md text-white/80 max-w-[80%]">Semangat belajar dan raih masa depanmu! 🌟</p>
        </div>
        <div class="mt-6 flex gap-3 relative z-10">
            <a href="{{ route('siswa.dashboard', ['page' => 'pelatihan']) }}" class="clay-button bg-secondary-container text-on-secondary-container font-label-md px-6 py-3 rounded-full flex items-center gap-2 transition-transform active:scale-95">
                <span class="material-symbols-outlined">play_arrow</span> Mulai Belajar
            </a>
        </div>
        <div class="absolute bottom-4 right-6 opacity-20 pointer-events-none">
            <span class="material-symbols-outlined text-[80px]">rocket_launch</span>
        </div>
    </div>
</section>

{{-- Stats Grid --}}
<section class="grid grid-cols-2 gap-4 mb-8">
    <div class="clay-card p-5 flex flex-col items-center text-center">
        <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed mb-3 flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
        </div>
        <p class="font-display-lg text-[24px] text-primary" id="videoCount">0</p>
        <p class="font-label-md text-on-surface-variant">Video Ditonton</p>
    </div>
    <div class="clay-card p-5 flex flex-col items-center text-center">
        <div class="w-12 h-12 rounded-2xl bg-secondary-fixed mb-3 flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-on-secondary-fixed-variant" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
        </div>
        <p class="font-display-lg text-[24px] text-primary" id="kuisCount">0</p>
        <p class="font-label-md text-on-surface-variant">Kuis Tersedia</p>
    </div>
</section>

{{-- Training Progress --}}
<section class="mb-8">
    <div class="clay-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-headline-md text-on-surface">Progress Belajar</h3>
        </div>
        <div class="space-y-5">
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">Video BISINDO</span>
                    <span class="font-label-md text-primary">65%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-secondary-container to-secondary w-[65%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">Pelatihan Kerja</span>
                    <span class="font-label-md text-primary">40%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-primary-container to-primary w-[40%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-label-md text-on-surface">Kuis Terselesaikan</span>
                    <span class="font-label-md text-primary">55%</span>
                </div>
                <div class="h-4 bg-surface-container-highest rounded-full overflow-hidden clay-inset">
                    <div class="h-full bg-gradient-to-r from-tertiary-container to-tertiary w-[55%] rounded-full shadow-[2px_0_8px_rgba(0,0,0,0.1)]"></div>
                </div>
            </div>
        </div>
        <div class="mt-6 p-4 bg-surface-container rounded-2xl border border-white/50 flex items-center gap-4">
            <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full bg-primary-fixed-dim border-2 border-white flex items-center justify-center text-[10px] font-bold text-on-primary-fixed-variant">+5</div>
            </div>
            <p class="text-[12px] font-medium text-on-surface-variant">Temanmu juga sedang belajar hari ini</p>
        </div>
    </div>
</section>

{{-- Job Recommendations --}}
<section class="mb-8">
    <h3 class="font-headline-md text-on-surface mb-4">Rekomendasi Karier Untukmu</h3>
    <a href="{{ route('siswa.dashboard', ['page' => 'karier']) }}" class="clay-card p-5 border-l-8 border-secondary-container flex gap-4 items-start mb-3 block hover:scale-[1.01] transition-transform">
        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-primary" style="font-size:28px;">code</span>
        </div>
        <div class="flex-1">
            <p class="font-headline-md text-[18px]">Programmer</p>
            <p class="font-label-md text-on-surface-variant mb-3">Banyak perusahaan membuka lowongan untuk penyandang tunarungu di bidang IT</p>
            <div class="flex gap-2">
                <span class="px-3 py-1 bg-tertiary-container/10 text-tertiary text-[12px] rounded-full font-bold">🔥 Cocok</span>
            </div>
        </div>
    </a>
    <a href="{{ route('siswa.dashboard', ['page' => 'karier']) }}" class="clay-card p-5 border-l-8 border-primary flex gap-4 items-start mb-3 block hover:scale-[1.01] transition-transform">
        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-secondary-container" style="font-size:28px;">palette</span>
        </div>
        <div class="flex-1">
            <p class="font-headline-md text-[18px]">Desainer Grafis</p>
            <p class="font-label-md text-on-surface-variant mb-3">Kreativitas visual adalah kekuatan yang tidak terbatas oleh pendengaran</p>
        </div>
    </a>
    <a href="{{ route('siswa.dashboard', ['page' => 'karier']) }}" class="clay-card p-5 border-l-8 border-tertiary flex gap-4 items-start block hover:scale-[1.01] transition-transform">
        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center clay-inset">
            <span class="material-symbols-outlined text-tertiary" style="font-size:28px;">bakery_dining</span>
        </div>
        <div class="flex-1">
            <p class="font-headline-md text-[18px]">Chef / Baker</p>
            <p class="font-label-md text-on-surface-variant mb-3">Industri kuliner sangat menghargai ketelitian dan kreativitas</p>
        </div>
    </a>
</section>

{{-- Edit Profile Modal --}}
<div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30 backdrop-blur-sm" id="editProfil" onclick="this.classList.add('hidden')">
    <div class="clay-card p-6 w-full max-w-md mx-4 rounded-xl" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-6">
            <h5 class="font-headline-md text-primary">Edit Profil</h5>
            <button type="button" onclick="document.getElementById('editProfil').classList.add('hidden')" class="text-outline hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="post" action="{{ route('siswa.profile.update') }}" enctype="multipart/form-data">
            @csrf
            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Nama Depan</label>
            <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                <input type="text" name="nama_depan" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" value="{{ Auth::user()->nama_depan }}" required>
            </div>

            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Nama Belakang</label>
            <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                <input type="text" name="nama_belakang" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" value="{{ Auth::user()->nama_belakang }}" required>
            </div>

            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Email</label>
            <div class="clay-inset rounded-lg px-4 py-3 mb-3">
                <input type="email" name="email" class="bg-transparent border-none focus:ring-0 w-full text-on-surface" value="{{ Auth::user()->email }}" required>
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

            <button type="submit" class="clay-button w-full py-4 rounded-lg text-white font-bold flex items-center justify-center gap-2 active:scale-95 transition-transform" style="background: linear-gradient(135deg, #fe8e2e 0%, #944a00 100%);">
                <span class="material-symbols-outlined">save</span> Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
fetch('{{ route("videos.index") }}?tipe=bisindo').then(r => r.json()).then(d => {
    if(d.success) document.getElementById('videoCount').textContent = d.total;
});
fetch('{{ route("kuis.index") }}?tipe=pelatihan').then(r => r.json()).then(d => {
    if(d.success) document.getElementById('kuisCount').textContent = d.data.length;
});
</script>

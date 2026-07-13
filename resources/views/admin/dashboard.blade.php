<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TUNAS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fbf8ff; overflow-x: hidden; min-height: max(884px, 100dvh); }
        .clay-card { background: #FAF5EF; border-radius: 2rem; box-shadow: 16px 16px 32px #A69B8F20, -12px -12px 24px #FFFFFF; position: relative; transition: all 0.3s ease; }
        .clay-button { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 8px 8px 16px #A69B8F30, -8px -8px 16px #FFFFFF; }
        .clay-button:active { box-shadow: inset 6px 6px 12px rgba(0,0,0,0.1), inset -6px -6px 12px rgba(255,255,255,0.8); transform: scale(0.96); }
        .clay-inset { box-shadow: inset 4px 4px 8px #A69B8F20, inset -4px -4px 8px #FFFFFF; }
        .drawer-transition { transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .nav-active-clay { box-shadow: inset 4px 4px 8px rgba(0,0,0,0.15); }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class", theme: { extend: {
                colors: { background: "#fbf8ff", primary: "#4156ab", "on-surface-variant": "#454651", "surface-container-high": "#e9e7ef", "surface-container": "#efedf5", outline: "#757683", secondary: "#944a00", "on-primary": "#ffffff", "primary-container": "#5b6fc6", "on-error": "#ffffff", "on-secondary-container": "#663100", "secondary-container": "#fe8e2e", tertiary: "#236a00", "on-surface": "#1a1b21", surface: "#fbf8ff", error: "#ba1a1a" },
                borderRadius: { DEFAULT: "1rem", lg: "2rem" },
                spacing: { "container-padding-mobile": "20px", gutter: "24px" },
                fontFamily: { "display-lg": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"], "body-md": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"] },
                fontSize: { "display-lg": ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "800" }], "label-md": ["14px", { lineHeight: "1.2", letterSpacing: "0.01em", fontWeight: "600" }], "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }], "headline-md": ["24px", { lineHeight: "1.4", fontWeight: "700" }] }
            } }
        }
    </script>
</head>
<body class="bg-background text-on-background">

{{-- Top App Bar --}}
<header class="fixed top-0 w-full z-40 bg-white/70 backdrop-blur-xl flex justify-between items-center px-container-padding-mobile py-4 shadow-[0_4px_30px_rgba(0,0,0,0.05)]">
    <div class="flex items-center gap-3">
        <button class="clay-button p-2 bg-surface rounded-full flex items-center justify-center text-primary transition-transform active:scale-90" id="menu-toggle">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <h1 class="font-display-lg text-[24px] font-extrabold text-primary tracking-tight">TUNAS Admin</h1>
    </div>
    <div class="relative">
        <div class="w-10 h-10 rounded-full bg-primary-fixed p-[3px] shadow-[8px_8px_16px_rgba(166,155,143,0.3)]">
            <img class="w-full h-full rounded-full bg-white object-cover" src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('images/user.png') }}" alt="{{ Auth::user()->nama_lengkap }}">
        </div>
    </div>
</header>

{{-- Drawer Overlay --}}
<div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-50 hidden transition-opacity duration-300 opacity-0" id="drawer-overlay"></div>

{{-- Navigation Drawer --}}
<nav class="fixed left-0 top-0 h-full w-72 bg-surface-container z-50 drawer-transition -translate-x-full flex flex-col p-8 rounded-r-[2.5rem] shadow-[16px_0_32px_rgba(166,155,143,0.15)]" id="nav-drawer">
    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-outline-variant/30">
        <div class="w-14 h-14 rounded-2xl bg-white shadow-[inset_4px_4px_8px_rgba(0,0,0,0.05),8px_8px_16px_rgba(166,155,143,0.2)] p-1">
            <img class="w-full h-full rounded-xl object-cover" src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('images/user.png') }}" alt="Profile">
        </div>
        <div>
            <p class="font-headline-md text-primary">{{ Auth::user()->nama_lengkap }}</p>
            <p class="font-label-md text-on-surface-variant">Administrator</p>
        </div>
    </div>
    <div class="flex flex-col gap-4">
        <a href="#" class="flex items-center gap-4 px-6 py-4 bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">speed</span>
            <span class="font-label-md">Dashboard</span>
        </a>
        <div class="mt-auto pt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-4 px-6 py-4 w-full text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95">
                    <span class="material-symbols-outlined text-error">logout</span>
                    <span class="font-label-md">Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main class="pt-24 pb-32 px-container-padding-mobile max-w-lg mx-auto">
    {{-- Welcome --}}
    <section class="mb-8">
        <div class="clay-card overflow-hidden relative p-6 bg-gradient-to-br from-primary to-primary-container text-white">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-[28px] font-bold mb-2">Dashboard Admin</h2>
                <p class="font-body-md text-white/80">Kelola seluruh aktivitas TUNAS di sini.</p>
            </div>
            <div class="absolute bottom-4 right-6 opacity-20 pointer-events-none">
                <span class="material-symbols-outlined text-[80px]">shield</span>
            </div>
        </div>
    </section>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="clay-card p-5 flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed mb-3 flex items-center justify-center clay-inset">
                <span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">group</span>
            </div>
            <p class="font-display-lg text-[24px] text-primary">{{ $totalUsers }}</p>
            <p class="font-label-md text-on-surface-variant">Total Pengguna</p>
            <p class="text-xs text-on-surface-variant mt-1">{{ $totalGuru }} Guru, {{ $totalSiswa }} Siswa</p>
        </div>
        <div class="clay-card p-5 flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-secondary-fixed mb-3 flex items-center justify-center clay-inset">
                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">videocam</span>
            </div>
            <p class="font-display-lg text-[24px] text-primary">{{ $totalVideos }}</p>
            <p class="font-label-md text-on-surface-variant">Total Video</p>
        </div>
        <div class="clay-card p-5 flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-secondary-fixed mb-3 flex items-center justify-center clay-inset">
                <span class="material-symbols-outlined text-on-secondary-fixed-variant" style="font-variation-settings: 'FILL' 1;">quiz</span>
            </div>
            <p class="font-display-lg text-[24px] text-primary">{{ $totalKuis }}</p>
            <p class="font-label-md text-on-surface-variant">Total Soal Kuis</p>
        </div>
        <div class="clay-card p-5 flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed mb-3 flex items-center justify-center clay-inset">
                <span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">work</span>
            </div>
            <p class="font-display-lg text-[24px] text-primary">{{ $totalKarir }}</p>
            <p class="font-label-md text-on-surface-variant">Profil Karier</p>
        </div>
    </div>

    {{-- Recent Users --}}
    <section>
        <h3 class="font-headline-md text-on-surface mb-4">Pengguna Terbaru</h3>
        <div class="clay-card p-0 overflow-hidden">
            <div class="divide-y divide-outline-variant/30">
                @foreach ($recentUsers as $u)
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center gap-3">
                        <img class="w-10 h-10 rounded-full object-cover bg-surface-container-high" src="{{ $u->foto ? asset('storage/'.$u->foto) : asset('images/user.png') }}" alt="{{ $u->nama_lengkap }}">
                        <div>
                            <p class="font-bold text-on-surface text-sm">{{ $u->nama_lengkap }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $u->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs px-3 py-1 rounded-full font-bold {{ $u->role === 'admin' ? 'bg-error/10 text-error' : ($u->role === 'guru' ? 'bg-primary/10 text-primary' : 'bg-tertiary/10 text-tertiary') }}">{{ ucfirst($u->role) }}</span>
                        <p class="text-xs text-on-surface-variant mt-1">{{ $u->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

{{-- Bottom Navigation --}}
<footer class="fixed bottom-0 w-full z-40 bg-surface/90 backdrop-blur-lg rounded-t-[2.5rem] shadow-[0_-8px_32px_rgba(166,155,143,0.1)]">
    <div class="flex justify-around items-center h-20 px-6">
        <a href="#" class="flex flex-col items-center justify-center bg-secondary-container text-on-secondary-container rounded-2xl px-5 py-2 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.15)] transition-transform hover:scale-110 active:scale-90">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">speed</span>
            <span class="text-[10px] font-bold mt-0.5">Dashboard</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-all active:scale-90" style="border:none;background:none;font-family:inherit;cursor:pointer;">
                <span class="material-symbols-outlined text-error">logout</span>
                <span class="text-[10px] font-bold mt-0.5">Logout</span>
            </button>
        </form>
    </div>
</footer>

{{-- FAB --}}
<button class="fixed right-6 bottom-24 w-16 h-16 bg-primary text-white rounded-2xl shadow-[8px_8px_20px_rgba(65,86,171,0.4),-4px_-4px_12px_rgba(255,255,255,0.8)] flex items-center justify-center clay-button z-40" onclick="scrollToTop()" id="fabBtn">
    <span class="material-symbols-outlined text-[32px]">arrow_upward</span>
</button>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const navDrawer = document.getElementById('nav-drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');

    function toggleDrawer() {
        const isOpen = !navDrawer.classList.contains('-translate-x-full');
        if (isOpen) {
            navDrawer.classList.add('-translate-x-full');
            drawerOverlay.classList.add('hidden');
            drawerOverlay.classList.remove('opacity-100');
            document.body.style.overflow = '';
        } else {
            navDrawer.classList.remove('-translate-x-full');
            drawerOverlay.classList.remove('hidden');
            setTimeout(() => drawerOverlay.classList.add('opacity-100'), 10);
            document.body.style.overflow = 'hidden';
        }
    }

    menuToggle.addEventListener('click', toggleDrawer);
    drawerOverlay.addEventListener('click', toggleDrawer);

    const fabBtn = document.getElementById('fabBtn');
    window.addEventListener('scroll', () => {
        fabBtn.style.display = window.scrollY > 400 ? 'flex' : 'none';
    });
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
</body>
</html>

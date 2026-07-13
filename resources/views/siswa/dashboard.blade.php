<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - TUNAS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fbf8ff; overflow-x: hidden; min-height: max(884px, 100dvh); }
        .clay-card { background: #FAF5EF; border-radius: 2rem; box-shadow: 16px 16px 32px #A69B8F20, -12px -12px 24px #FFFFFF; position: relative; transition: all 0.3s ease; }
        .clay-card-inner { box-shadow: inset 8px 8px 16px #FFFFFF, inset -8px -8px 16px #A69B8F15; border-radius: 2rem; }
        .clay-button { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 8px 8px 16px #A69B8F30, -8px -8px 16px #FFFFFF; }
        .clay-button:active { box-shadow: inset 6px 6px 12px rgba(0,0,0,0.1), inset -6px -6px 12px rgba(255,255,255,0.8); transform: scale(0.96); }
        .clay-inset { box-shadow: inset 4px 4px 8px #A69B8F20, inset -4px -4px 8px #FFFFFF; }
        .glass-nav { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        .drawer-transition { transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .nav-active-clay { box-shadow: inset 4px 4px 8px rgba(0,0,0,0.15); }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class", theme: { extend: {
                colors: { background: "#fbf8ff", primary: "#4156ab", "tertiary-fixed-dim": "#81dc5a", "on-surface-variant": "#454651", "on-error-container": "#93000a", error: "#ba1a1a", "on-tertiary-container": "#f8ffee", "secondary-fixed-dim": "#ffb783", "on-secondary-fixed-variant": "#713700", "surface-container-high": "#e9e7ef", "on-secondary-fixed": "#301400", "surface-container": "#efedf5", outline: "#757683", "surface-container-highest": "#e3e1e9", secondary: "#944a00", "primary-fixed-dim": "#b8c4ff", "inverse-primary": "#b8c4ff", "on-secondary": "#ffffff", "surface-container-low": "#f4f2fb", "on-tertiary": "#ffffff", "on-primary": "#ffffff", "on-primary-container": "#fffbff", "surface-variant": "#e3e1e9", "on-primary-fixed-variant": "#2a3f94", "on-tertiary-fixed-variant": "#195200", "secondary-fixed": "#ffdcc5", "surface-tint": "#4458ad", "tertiary-container": "#2e8602", "inverse-on-surface": "#f2f0f8", "primary-container": "#5b6fc6", "surface-container-lowest": "#ffffff", "error-container": "#ffdad6", "primary-fixed": "#dde1ff", "on-error": "#ffffff", "on-secondary-container": "#663100", "secondary-container": "#fe8e2e", "on-background": "#1a1b21", "inverse-surface": "#2f3036", tertiary: "#236a00", "on-tertiary-fixed": "#062100", "on-primary-fixed": "#001354", "tertiary-fixed": "#9cf973", "on-surface": "#1a1b21", surface: "#fbf8ff", "surface-bright": "#fbf8ff", "surface-dim": "#dbd9e1", "outline-variant": "#c5c5d3" },
                borderRadius: { DEFAULT: "1rem", lg: "2rem", xl: "3rem", full: "9999px" },
                spacing: { "container-padding-mobile": "20px", "clay-padding": "32px", base: "8px", gutter: "24px", "container-padding-desktop": "40px" },
                fontFamily: { "display-lg": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"], "body-md": ["Plus Jakarta Sans"], "body-lg": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"], "headline-lg": ["Plus Jakarta Sans"], "headline-lg-mobile": ["Plus Jakarta Sans"] },
                fontSize: { "display-lg": ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "800" }], "label-md": ["14px", { lineHeight: "1.2", letterSpacing: "0.01em", fontWeight: "600" }], "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }], "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "500" }], "headline-md": ["24px", { lineHeight: "1.4", fontWeight: "700" }], "headline-lg": ["32px", { lineHeight: "1.3", fontWeight: "700" }], "headline-lg-mobile": ["28px", { lineHeight: "1.3", fontWeight: "700" }] }
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
        <h1 class="font-display-lg text-headline-lg-mobile font-extrabold text-primary tracking-tight">TUNAS</h1>
    </div>
    <div class="relative">
        <div class="w-10 h-10 rounded-full bg-primary-fixed p-[3px] shadow-[8px_8px_16px_rgba(166,155,143,0.3)]">
            <img class="w-full h-full rounded-full bg-white object-cover" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/user.png') }}" alt="{{ Auth::user()->nama_lengkap }}">
        </div>
    </div>
</header>

{{-- Navigation Drawer Overlay --}}
<div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-50 hidden transition-opacity duration-300 opacity-0" id="drawer-overlay"></div>

{{-- Navigation Drawer --}}
<nav class="fixed left-0 top-0 h-full w-72 max-w-[85vw] bg-surface-container z-50 drawer-transition -translate-x-full flex flex-col p-6 md:p-8 rounded-r-[2.5rem] shadow-[16px_0_32px_rgba(166,155,143,0.15)] overflow-y-auto overscroll-contain" id="nav-drawer">
    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-outline-variant/30">
        <div class="w-14 h-14 rounded-2xl bg-white shadow-[inset_4px_4px_8px_rgba(0,0,0,0.05),8px_8px_16px_rgba(166,155,143,0.2)] p-1">
            <img class="w-full h-full rounded-xl object-cover" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/user.png') }}" alt="Profile">
        </div>
        <div>
            <p class="font-headline-md text-primary">{{ Auth::user()->nama_lengkap }}</p>
            <p class="font-label-md text-on-surface-variant">Siswa</p>
        </div>
    </div>
    <div class="flex flex-col gap-4">
        <a href="{{ route('siswa.dashboard', ['page' => 'beranda']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? 'beranda') == 'beranda' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? 'beranda') == 'beranda' ? 'font-variation-settings: FILL 1;' : '' }}">dashboard</span>
            <span class="font-label-md">Beranda</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'pelatihan']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? '') == 'pelatihan' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? '') == 'pelatihan' ? 'font-variation-settings: FILL 1;' : '' }}">school</span>
            <span class="font-label-md">Pelatihan</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'video']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? '') == 'video' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? '') == 'video' ? 'font-variation-settings: FILL 1;' : '' }}">videocam</span>
            <span class="font-label-md">Video BISINDO</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'kuis']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? '') == 'kuis' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? '') == 'kuis' ? 'font-variation-settings: FILL 1;' : '' }}">quiz</span>
            <span class="font-label-md">Kuis</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'karier']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? '') == 'karier' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? '') == 'karier' ? 'font-variation-settings: FILL 1;' : '' }}">work</span>
            <span class="font-label-md">Karier</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'kamus']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? '') == 'kamus' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? '') == 'kamus' ? 'font-variation-settings: FILL 1;' : '' }}">book</span>
            <span class="font-label-md">Kosa Kata</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'konseling']) }}" class="flex items-center gap-4 px-6 py-4 {{ ($page ?? '') == 'konseling' ? 'bg-primary-container text-on-primary-container rounded-2xl nav-active-clay scale-[1.02]' : 'text-on-surface-variant hover:bg-surface-container-high rounded-2xl transition-transform hover:translate-x-1 active:scale-95' }}">
            <span class="material-symbols-outlined" style="{{ ($page ?? '') == 'konseling' ? 'font-variation-settings: FILL 1;' : '' }}">group</span>
            <span class="font-label-md">Konseling</span>
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
<main class="pt-24 pb-32 px-container-padding-mobile max-w-lg mx-auto" id="mainContent">
    @if (($page ?? 'beranda') === 'beranda')
        @include('siswa.beranda')
    @elseif (($page ?? '') === 'pelatihan')
        @php $tipeView = 'pelatihan'; @endphp
        @include('siswa.viewer')
    @elseif (($page ?? '') === 'video')
        @php $tipeView = 'bisindo'; @endphp
        @include('siswa.viewer')
    @elseif (($page ?? '') === 'kuis')
        @include('siswa.kuis')
    @elseif (($page ?? '') === 'karier')
        @include('siswa.karier')
    @elseif (($page ?? '') === 'kamus')
        @php $tipeView = 'kosa_kata'; @endphp
        @include('siswa.viewer')
    @elseif (($page ?? '') === 'konseling')
        @include('siswa.konseling')
    @endif
</main>

{{-- Bottom Navigation --}}
<footer class="fixed bottom-0 w-full z-40 bg-surface/90 backdrop-blur-lg rounded-t-[2.5rem] shadow-[0_-8px_32px_rgba(166,155,143,0.1)]">
    <div class="flex justify-around items-center h-20 px-6">
        <a href="{{ route('siswa.dashboard', ['page' => 'beranda']) }}" class="flex flex-col items-center justify-center {{ ($page ?? 'beranda') == 'beranda' ? 'bg-secondary-container text-on-secondary-container rounded-2xl px-5 py-2 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.15)]' : 'text-on-surface-variant' }} transition-transform hover:scale-110 active:scale-90">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
            <span class="text-[10px] font-bold mt-0.5">Home</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'pelatihan']) }}" class="hidden md:flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-all active:scale-90">
            <span class="material-symbols-outlined">menu_book</span>
            <span class="text-[10px] font-bold mt-0.5">Belajar</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'konseling']) }}" class="flex flex-col items-center justify-center {{ ($page ?? '') == 'konseling' ? 'bg-secondary-container text-on-secondary-container rounded-2xl px-5 py-2 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.15)]' : 'text-on-surface-variant' }} transition-transform hover:scale-110 active:scale-90">
            <span class="material-symbols-outlined">group</span>
            <span class="text-[10px] font-bold mt-0.5">Konseling</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'karier']) }}" class="hidden md:flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-all active:scale-90">
            <span class="material-symbols-outlined">business_center</span>
            <span class="text-[10px] font-bold mt-0.5">Karier</span>
        </a>
        <a href="{{ route('siswa.dashboard', ['page' => 'beranda']) }}" class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-all active:scale-90">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="text-[10px] font-bold mt-0.5">Profil</span>
        </a>
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

    function closeDrawer() {
        navDrawer.classList.add('-translate-x-full');
        drawerOverlay.classList.add('hidden');
        drawerOverlay.classList.remove('opacity-100');
        document.body.style.overflow = '';
    }

    function toggleDrawer() {
        const isOpen = !navDrawer.classList.contains('-translate-x-full');
        if (isOpen) {
            closeDrawer();
        } else {
            navDrawer.classList.remove('-translate-x-full');
            drawerOverlay.classList.remove('hidden');
            setTimeout(() => drawerOverlay.classList.add('opacity-100'), 10);
            document.body.style.overflow = 'hidden';
        }
    }

    menuToggle.addEventListener('click', toggleDrawer);
    drawerOverlay.addEventListener('click', toggleDrawer);

    document.querySelectorAll('#nav-drawer a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) closeDrawer();
        });
    });

    // FAB scroll
    const fabBtn = document.getElementById('fabBtn');
    window.addEventListener('scroll', () => {
        fabBtn.style.display = window.scrollY > 400 ? 'flex' : 'none';
    });
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

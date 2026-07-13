<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TUNAS - Tunarungu Siap</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#fbf8ff",
                        "primary": "#4156ab",
                        "tertiary-fixed-dim": "#81dc5a",
                        "on-surface-variant": "#454651",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#f8ffee",
                        "secondary-fixed-dim": "#ffb783",
                        "on-secondary-fixed-variant": "#713700",
                        "surface-container-high": "#e9e7ef",
                        "on-secondary-fixed": "#301400",
                        "surface-container": "#efedf5",
                        "outline": "#757683",
                        "surface-container-highest": "#e3e1e9",
                        "secondary": "#944a00",
                        "primary-fixed-dim": "#b8c4ff",
                        "inverse-primary": "#b8c4ff",
                        "on-secondary": "#ffffff",
                        "surface-container-low": "#f4f2fb",
                        "on-tertiary": "#ffffff",
                        "on-primary": "#ffffff",
                        "on-primary-container": "#fffbff",
                        "surface-variant": "#e3e1e9",
                        "on-primary-fixed-variant": "#2a3f94",
                        "on-tertiary-fixed-variant": "#195200",
                        "secondary-fixed": "#ffdcc5",
                        "surface-tint": "#4458ad",
                        "tertiary-container": "#2e8602",
                        "inverse-on-surface": "#f2f0f8",
                        "primary-container": "#5b6fc6",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#dde1ff",
                        "on-error": "#ffffff",
                        "on-secondary-container": "#663100",
                        "secondary-container": "#fe8e2e",
                        "on-background": "#1a1b21",
                        "inverse-surface": "#2f3036",
                        "tertiary": "#236a00",
                        "on-tertiary-fixed": "#062100",
                        "on-primary-fixed": "#001354",
                        "tertiary-fixed": "#9cf973",
                        "on-surface": "#1a1b21",
                        "surface": "#fbf8ff",
                        "surface-bright": "#fbf8ff",
                        "surface-dim": "#dbd9e1",
                        "outline-variant": "#c5c5d3"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-padding-mobile": "20px",
                        "clay-padding": "32px",
                        "base": "8px",
                        "gutter": "24px",
                        "container-padding-desktop": "40px"
                    },
                    "fontFamily": {
                        "display-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "label-md": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "500"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "500"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "700"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}]
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #fbf8ff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }
        .clay-card {
            background-color: #FAF5EF;
            box-shadow: 10px 10px 20px #A69B8F1A, -10px -10px 20px #FFFFFF;
            position: relative;
            transition: all 0.3s ease;
        }
        .clay-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 2px;
            background: linear-gradient(135deg, rgba(255,255,255,1), rgba(255,255,255,0));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }
        .clay-card-inner {
            box-shadow: inset 6px 6px 12px rgba(255,255,255,0.8), inset -6px -6px 12px rgba(166, 155, 143, 0.15);
        }
        .clay-button-orange {
            background: linear-gradient(135deg, #ff8f2f, #ff6a00);
            box-shadow: 4px 4px 10px rgba(255, 111, 0, 0.3), inset 2px 2px 4px rgba(255, 255, 255, 0.4);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .clay-button-orange:active {
            transform: scale(0.96);
            box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .clay-input {
            background: #F5F0EB;
            box-shadow: inset 4px 4px 8px rgba(166, 155, 143, 0.2), inset -4px -4px 8px rgba(255, 255, 255, 0.8);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .floating-emoji {
            animation: float 4s ease-in-out infinite;
            font-size: 2.5rem;
            position: absolute;
        }
        .stagger-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .stagger-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-background text-on-background">

{{-- TopAppBar Navigation Shell --}}
<nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)] px-container-padding-mobile md:px-container-padding-desktop py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-4xl font-variation-fill">back_hand</span>
        <span class="font-display-lg text-[24px] font-extrabold text-primary tracking-tight">TUNAS</span>
    </div>
    <div class="hidden md:flex items-center gap-8">
        <a class="text-primary font-bold transition-all duration-300" href="#home">Beranda</a>
        <a class="text-on-surface-variant hover:text-primary transition-all duration-300" href="#tentang">Tentang</a>
        <a class="text-on-surface-variant hover:text-primary transition-all duration-300" href="#statistik">Statistik</a>
        <a class="clay-button-orange text-white px-5 py-2.5 rounded-lg font-bold flex items-center gap-2" href="{{ route('login') }}">
            <span class="material-symbols-outlined" style="font-size:20px;">login</span> Masuk
        </a>
    </div>
    <button class="md:hidden material-symbols-outlined text-primary text-3xl" onclick="toggleMobileMenu()">menu</button>
</nav>

{{-- Mobile Navigation Drawer --}}
<div class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm hidden" id="mobile-menu" onclick="toggleMobileMenu()">
    <div class="h-full w-72 bg-surface-container shadow-[16px_0_16px_rgba(166,155,143,0.1)] flex flex-col p-8 transform -translate-x-full transition-transform duration-300" id="drawer-content" onclick="event.stopPropagation()">
        <div class="mb-10">
            <span class="material-symbols-outlined text-primary text-5xl mb-4 block font-variation-fill">back_hand</span>
            <h2 class="font-display-lg text-headline-lg-mobile text-primary">TUNAS</h2>
        </div>
        <div class="flex flex-col gap-4">
            <a class="flex items-center gap-4 p-4 bg-primary-container text-on-primary-container rounded-lg shadow-inner" href="#home">
                <span class="material-symbols-outlined">home</span>
                <span class="font-label-md">Beranda</span>
            </a>
            <a class="flex items-center gap-4 p-4 text-on-surface-variant hover:bg-surface-container-high rounded-lg transition-transform hover:translate-x-1" href="#tentang">
                <span class="material-symbols-outlined">school</span>
                <span class="font-label-md">Tentang</span>
            </a>
            <a class="flex items-center gap-4 p-4 text-on-surface-variant hover:bg-surface-container-high rounded-lg transition-transform hover:translate-x-1" href="#statistik">
                <span class="material-symbols-outlined">bar_chart</span>
                <span class="font-label-md">Statistik</span>
            </a>
            <a class="flex items-center gap-4 p-4 mt-4 clay-button-orange text-white rounded-lg justify-center" href="{{ route('login') }}">
                <span class="material-symbols-outlined" style="font-size:20px;">login</span>
                <span class="font-label-md">Masuk</span>
            </a>
        </div>
    </div>
</div>

{{-- Hero Section --}}
<section class="relative pt-32 pb-20 md:pt-48 md:pb-32 px-container-padding-mobile md:px-container-padding-desktop overflow-hidden bg-[#f5f0eb]" id="home">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="text-center lg:text-left z-10">
            <h1 class="font-display-lg text-[2.5rem] md:text-display-lg text-primary mb-4 leading-tight">
                Masa Depan Inklusif Bersama <span class="text-secondary-container">TUNAS</span>
            </h1>
            <p class="font-body-lg text-on-surface-variant mb-10 max-w-xl mx-auto lg:mx-0">
                Tunarungu Siap: Platform pemberdayaan tenaga kerja tunarungu melalui pelatihan berbasis BISINDO dan koneksi karir impian.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('login') }}" class="clay-button-orange text-white px-8 py-4 rounded-lg font-bold text-lg flex items-center justify-center gap-2">
                    Mulai Belajar <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="{{ route('login') }}" class="clay-card clay-card-inner px-8 py-4 rounded-lg font-bold text-primary flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">work</span> Cari Pekerjaan
                </a>
            </div>
        </div>
        <div class="relative flex justify-center items-center h-[400px] md:h-[500px]">
            <div class="floating-emoji" style="top: 10%; left: 10%; animation-delay: 0s;">👌</div>
            <div class="floating-emoji" style="top: 20%; right: 15%; animation-delay: 0.5s;">✌️</div>
            <div class="floating-emoji" style="bottom: 25%; left: 15%; animation-delay: 1.2s;">👍</div>
            <div class="floating-emoji" style="bottom: 10%; right: 20%; animation-delay: 0.8s;">👋</div>
            <div class="clay-card rounded-full w-64 h-64 md:w-80 md:h-80 flex items-center justify-center p-8">
                <div class="clay-card-inner rounded-full w-full h-full flex items-center justify-center overflow-hidden bg-white/50">
                    <img class="w-full h-full object-contain p-4" src="{{ asset('images/character.png') }}" alt="Karakter TUNAS">
                </div>
            </div>
        </div>
    </div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary-container/10 rounded-full blur-3xl"></div>
</section>

{{-- Stats Section --}}
<section class="py-20 px-container-padding-mobile md:px-container-padding-desktop bg-white" id="statistik">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-4">Dampak Nyata Kami</h2>
            <div class="h-1.5 w-24 bg-secondary-container mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <div class="clay-card stagger-in rounded-lg p-8 text-center" style="transition-delay: 100ms;">
                <div class="clay-card-inner w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 text-primary">
                    <span class="material-symbols-outlined text-4xl">groups</span>
                </div>
                <div class="font-display-lg text-4xl text-primary mb-2">2,500+</div>
                <div class="font-label-md text-on-surface-variant">Siswa Terdaftar</div>
                <p class="mt-4 font-body-md text-outline">Talenta tunarungu yang siap menggebrak dunia industri digital.</p>
            </div>
            <div class="clay-card stagger-in rounded-lg p-8 text-center" style="transition-delay: 300ms;">
                <div class="clay-card-inner w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 text-secondary-container">
                    <span class="material-symbols-outlined text-4xl">work_history</span>
                </div>
                <div class="font-display-lg text-4xl text-primary mb-2">850+</div>
                <div class="font-label-md text-on-surface-variant">Lulusan Bekerja</div>
                <p class="mt-4 font-body-md text-outline">Berhasil ditempatkan di berbagai perusahaan teknologi ternama.</p>
            </div>
            <div class="clay-card stagger-in rounded-lg p-8 text-center" style="transition-delay: 500ms;">
                <div class="clay-card-inner w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 text-tertiary">
                    <span class="material-symbols-outlined text-4xl">handshake</span>
                </div>
                <div class="font-display-lg text-4xl text-primary mb-2">120+</div>
                <div class="font-label-md text-on-surface-variant">Mitra Perusahaan</div>
                <p class="mt-4 font-body-md text-outline">Korporasi yang berkomitmen menciptakan lingkungan inklusif.</p>
            </div>
        </div>
    </div>
</section>

{{-- Bento Grid Featured Section --}}
<section class="py-20 px-container-padding-mobile md:px-container-padding-desktop bg-[#fbf8ff]" id="tentang">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-4">Apa yang Ada di TUNAS?</h2>
            <div class="h-1.5 w-24 bg-primary mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-6 h-auto md:h-[600px]">
            <div class="md:col-span-2 md:row-span-2 clay-card rounded-lg overflow-hidden group">
                <div class="p-8 h-full flex flex-col justify-between">
                    <div>
                        <span class="bg-primary/10 text-primary px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-block">Unggulan</span>
                        <h3 class="font-headline-lg text-primary mb-4">Pelatihan BISINDO Intensif</h3>
                        <p class="text-on-surface-variant font-body-md">Kurikulum terstruktur untuk menguasai Bahasa Isyarat Indonesia dalam konteks profesional dan sehari-hari.</p>
                    </div>
                    <div class="mt-8 rounded-lg h-48 w-full bg-primary/5 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-7xl">sign_language</span>
                    </div>
                </div>
            </div>
            <div class="md:col-span-2 clay-card rounded-lg flex items-center p-8 gap-6">
                <div class="flex-1">
                    <h3 class="font-headline-md text-primary mb-2">Penyaluran Kerja</h3>
                    <p class="text-on-surface-variant font-body-md">Koneksi langsung dengan HRD yang ramah disabilitas.</p>
                </div>
                <div class="w-24 h-24 clay-card-inner rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-secondary-container text-4xl">business_center</span>
                </div>
            </div>
            <div class="md:col-span-1 clay-card rounded-lg p-6 flex flex-col justify-center text-center">
                <span class="material-symbols-outlined text-tertiary text-5xl mb-4">forum</span>
                <h4 class="font-headline-md text-primary">Komunitas</h4>
                <p class="text-outline text-sm">Ruang berbagi & tumbuh bersama.</p>
            </div>
            <div class="md:col-span-1 clay-card rounded-lg p-6 flex flex-col justify-center text-center">
                <span class="material-symbols-outlined text-secondary-container text-5xl mb-4">verified</span>
                <h4 class="font-headline-md text-primary">Sertifikasi</h4>
                <p class="text-outline text-sm">Akreditasi resmi standar nasional.</p>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="bg-surface-container py-12 px-container-padding-mobile md:px-container-padding-desktop">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-3xl font-variation-fill">back_hand</span>
            <span class="font-display-lg text-xl font-extrabold text-primary">TUNAS</span>
        </div>
        <div class="flex gap-8 text-on-surface-variant font-label-md">
            <a class="hover:text-primary" href="#tentang">Tentang Kami</a>
            <a class="hover:text-primary" href="#">Kebijakan Privasi</a>
            <a class="hover:text-primary" href="#home">Kontak</a>
        </div>
        <div class="text-outline text-sm">
            &copy; {{ date('Y') }} TUNAS. Indonesia Inklusif.
        </div>
    </div>
</footer>

{{-- Bottom Nav (Mobile Only) --}}
<nav class="md:hidden fixed bottom-0 w-full bg-surface-container-highest z-50 rounded-t-lg shadow-[0_-8px_24px_rgba(166,155,143,0.1)] flex justify-around items-center h-20 px-4">
    <a class="flex flex-col items-center justify-center bg-secondary-container text-on-secondary-container rounded-xl px-4 py-2 shadow-[inset_2px_2px_4px_rgba(0,0,0,0.15)]" href="#home">
        <span class="material-symbols-outlined">home</span>
        <span class="text-[10px] font-bold">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-transform px-4 py-2" href="#tentang">
        <span class="material-symbols-outlined">menu_book</span>
        <span class="text-[10px] font-bold">Belajar</span>
    </a>
    <a class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-transform px-4 py-2" href="{{ route('login') }}">
        <span class="material-symbols-outlined">account_circle</span>
        <span class="text-[10px] font-bold">Masuk</span>
    </a>
</nav>

<script>
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    document.querySelectorAll('.stagger-in').forEach(el => observer.observe(el));

    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const content = document.getElementById('drawer-content');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            setTimeout(() => { content.classList.remove('-translate-x-full'); }, 10);
        } else {
            content.classList.add('-translate-x-full');
            setTimeout(() => { menu.classList.add('hidden'); }, 300);
        }
    }
</script>
</body>
</html>

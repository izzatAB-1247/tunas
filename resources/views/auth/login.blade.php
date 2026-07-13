<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUNAS - Masuk</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f5f0eb; overflow: hidden; }
        .clay-card { background-color: #FAF5EF; box-shadow: 16px 16px 32px #A69B8F, -12px -12px 24px #FFFFFF; position: relative; overflow: hidden; }
        .clay-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: inherit; box-shadow: inset 12px 12px 24px rgba(255, 255, 255, 1), inset -12px -12px 24px rgba(166, 155, 143, 0.2); pointer-events: none; }
        .clay-input-container { background-color: #F5F0EB; box-shadow: inset 6px 6px 12px rgba(166, 155, 143, 0.3), inset -6px -6px 12px rgba(255, 255, 255, 0.8); border: none; transition: all 0.3s ease; }
        .clay-input-container:focus-within { box-shadow: inset 8px 8px 16px rgba(166, 155, 143, 0.4), inset -8px -8px 16px rgba(255, 255, 255, 1); }
        .clay-button { background: linear-gradient(135deg, #fe8e2e 0%, #944a00 100%); box-shadow: 8px 8px 16px rgba(148, 74, 0, 0.3), -4px -4px 12px rgba(255, 255, 255, 0.5), inset 4px 4px 8px rgba(255, 255, 255, 0.3); transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .clay-button:hover { transform: translateY(-2px) scale(1.02); box-shadow: 10px 10px 20px rgba(148, 74, 0, 0.4), -6px -6px 16px rgba(255, 255, 255, 0.6); }
        .clay-button:active { transform: scale(0.96); box-shadow: inset 6px 6px 12px rgba(0, 0, 0, 0.2), inset -4px -4px 8px rgba(255, 255, 255, 0.1); }
        @keyframes scaleIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
        .animate-scale-in { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        background: "#fbf8ff", primary: "#4156ab",
                        "on-surface-variant": "#454651", "on-primary": "#ffffff",
                        "primary-container": "#5b6fc6", "secondary-container": "#fe8e2e",
                        "on-secondary-container": "#663100", surface: "#fbf8ff", outline: "#757683"
                    },
                    borderRadius: { DEFAULT: "1rem", lg: "2rem", xl: "3rem" },
                    spacing: { "clay-padding": "32px", "container-padding-desktop": "40px" },
                    fontFamily: { "display-lg": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"], "body-md": ["Plus Jakarta Sans"] },
                    fontSize: {
                        "display-lg": ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "800" }],
                        "label-md": ["14px", { lineHeight: "1.2", letterSpacing: "0.01em", fontWeight: "600" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <main class="w-full max-w-[480px] animate-scale-in">
        <div class="clay-card rounded-xl p-clay-padding flex flex-col items-center">
            {{-- Brand Logo --}}
            <div class="mb-8">
                <div class="w-24 h-24 rounded-full bg-white/50 flex items-center justify-center shadow-inner">
                    <span class="material-symbols-outlined text-primary" style="font-size:48px;font-variation-settings:'FILL' 1;">back_hand</span>
                </div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="font-display-lg text-[32px] md:text-display-lg text-primary mb-2">Selamat Datang</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Lanjutkan perjalananmu bersama TUNAS</p>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="w-full bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
                    {{ $errors->first('email') }}
                </div>
            @endif

            {{-- Form --}}
            <form class="w-full space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label class="font-label-md text-label-md text-primary ml-2">Email</label>
                    <div class="clay-input-container rounded-lg flex items-center px-4 py-4 group">
                        <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-3">mail</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                            placeholder="nama@email.com">
                    </div>
                </div>

                {{-- Password --}}
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center px-2">
                        <label class="font-label-md text-label-md text-primary">Password</label>
                        <a href="#" class="font-label-md text-label-md text-primary/70 hover:text-primary transition-colors">Lupa?</a>
                    </div>
                    <div class="clay-input-container rounded-lg flex items-center px-4 py-4 group">
                        <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-3">lock</span>
                        <input id="password" type="password" name="password" required
                            class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                            placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">
                        <button type="button" onclick="togglePassword()" class="text-outline hover:text-primary transition-colors">
                            <span class="material-symbols-outlined" id="passIcon">visibility</span>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2 px-2">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-5 h-5 rounded border-none clay-input-container text-primary focus:ring-primary/20 transition-all cursor-pointer">
                    <label class="font-label-md text-label-md text-on-surface-variant cursor-pointer" for="remember">Ingat saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="clay-button w-full py-5 rounded-lg text-white font-headline-md text-lg mt-2 active:scale-95 transition-transform flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">login</span> Masuk
                </button>
            </form>

            {{-- Divider --}}
            <div class="w-full flex items-center my-6">
                <div class="flex-1 h-[2px] bg-outline/10"></div>
                <span class="px-4 font-label-md text-label-md text-outline/60">ATAU</span>
                <div class="flex-1 h-[2px] bg-outline/10"></div>
            </div>

            {{-- Social Login --}}
            <div class="flex gap-4 w-full mb-6">
                <button type="button" class="flex-1 clay-input-container py-3 rounded-lg flex justify-center items-center hover:scale-[1.02] active:scale-[0.98] transition-all gap-2 text-on-surface-variant font-label-md" onclick="alert('Fitur Google Login akan segera hadir!')">
                    <span class="material-symbols-outlined text-primary">google</span> Google
                </button>
                <button type="button" class="flex-1 clay-input-container py-3 rounded-lg flex justify-center items-center hover:scale-[1.02] active:scale-[0.98] transition-all gap-2 text-on-surface-variant font-label-md" onclick="alert('Fitur Microsoft Login akan segera hadir!')">
                    <span class="material-symbols-outlined text-primary">apps</span> Microsoft
                </button>
            </div>

            {{-- Register Link --}}
            <div class="text-center">
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary font-bold hover:underline transition-all">Daftar di sini</a>
                </p>
            </div>
        </div>

        <p class="mt-6 text-center font-label-md text-label-md text-outline/50 px-8">
            Dengan melanjutkan, kamu menyetujui Ketentuan Layanan dan Kebijakan Privasi TUNAS.
        </p>
    </main>

    {{-- Decorative Blobs --}}
    <div class="fixed top-[-10%] right-[-10%] w-[400px] h-[400px] bg-primary/5 rounded-full blur-[80px] -z-10"></div>
    <div class="fixed bottom-[-5%] left-[-5%] w-[300px] h-[300px] bg-secondary-container/10 rounded-full blur-[60px] -z-10"></div>

    <script>
        const card = document.querySelector('.clay-card');
        document.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 45;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 45;
            card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
        document.addEventListener('mouseleave', () => {
            card.style.transform = `rotateY(0deg) rotateX(0deg)`;
            card.style.transition = 'transform 0.5s ease';
        });
        document.addEventListener('mouseenter', () => {
            card.style.transition = 'none';
        });

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('passIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>

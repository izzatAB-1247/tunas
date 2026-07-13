<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUNAS - Daftar</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f5f0eb; overflow-x: hidden; }
        .clay-card { background-color: #FAF5EF; box-shadow: 16px 16px 32px #A69B8F, -12px -12px 24px #FFFFFF; position: relative; overflow: hidden; }
        .clay-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: inherit; box-shadow: inset 12px 12px 24px rgba(255, 255, 255, 1), inset -12px -12px 24px rgba(166, 155, 143, 0.2); pointer-events: none; }
        .clay-card-sm { background-color: #FAF5EF; box-shadow: 8px 8px 16px #A69B8F, -6px -6px 12px #FFFFFF; position: relative; }
        .clay-card-sm::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: inherit; box-shadow: inset 6px 6px 12px rgba(255, 255, 255, 1), inset -6px -6px 12px rgba(166, 155, 143, 0.2); pointer-events: none; }
        .clay-input-container { background-color: #F5F0EB; box-shadow: inset 6px 6px 12px rgba(166, 155, 143, 0.3), inset -6px -6px 12px rgba(255, 255, 255, 0.8); border: none; transition: all 0.3s ease; }
        .clay-input-container:focus-within { box-shadow: inset 8px 8px 16px rgba(166, 155, 143, 0.4), inset -8px -8px 16px rgba(255, 255, 255, 1); }
        .clay-button { background: linear-gradient(135deg, #fe8e2e 0%, #944a00 100%); box-shadow: 8px 8px 16px rgba(148, 74, 0, 0.3), -4px -4px 12px rgba(255, 255, 255, 0.5), inset 4px 4px 8px rgba(255, 255, 255, 0.3); transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .clay-button:hover { transform: translateY(-2px) scale(1.02); box-shadow: 10px 10px 20px rgba(148, 74, 0, 0.4), -6px -6px 16px rgba(255, 255, 255, 0.6); }
        .clay-button:active { transform: scale(0.96); box-shadow: inset 6px 6px 12px rgba(0, 0, 0, 0.2), inset -4px -4px 8px rgba(255, 255, 255, 0.1); }
        .clay-button:disabled { opacity: 0.5; cursor: not-allowed; transform: none !important; }
        @keyframes scaleIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
        @keyframes fadeInRight { 0% { opacity: 0; transform: translateX(30px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-16px) rotate(3deg); } }
        .animate-scale-in { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .animate-fade-right { animation: fadeInRight 0.6s ease-out forwards; }
        .floating-emoji { animation: float 3.5s ease-in-out infinite; }
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
                        "on-secondary-container": "#663100", surface: "#fbf8ff", outline: "#757683",
                        tertiary: "#236a00"
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
<body class="min-h-screen flex items-center justify-center p-4 py-8">
    <main class="w-full max-w-[900px] animate-scale-in">
        <div class="flex flex-col lg:flex-row items-start justify-center gap-6">
            {{-- Left: Brand + Role Selection --}}
            <div class="w-full lg:w-auto text-center animate-fade-right shrink-0">
                <div class="clay-card-sm rounded-xl p-6 inline-flex flex-col items-center mb-6">
                    <div class="flex gap-4">
                        <div onclick="selectRole('guru')" id="guruCard"
                            class="clay-card-sm rounded-lg p-5 text-center cursor-pointer transition-all hover:scale-105" style="width:150px;">
                            <div class="text-5xl mb-2">👨‍🏫</div>
                            <div class="font-bold text-on-surface">GURU</div>
                            <div class="text-xs text-on-surface-variant mt-1">Pendidik & Pembimbing</div>
                        </div>
                        <div onclick="selectRole('siswa')" id="siswaCard"
                            class="clay-card-sm rounded-lg p-5 text-center cursor-pointer transition-all hover:scale-105" style="width:150px;">
                            <div class="text-5xl mb-2">🎓</div>
                            <div class="font-bold text-on-surface">SISWA</div>
                            <div class="text-xs text-on-surface-variant mt-1">Peserta Didik</div>
                        </div>
                    </div>
                </div>
                <div class="relative inline-block">
                    <div class="floating-emoji absolute text-3xl" style="top:-15%;left:-15%;animation-delay:0s;">👌</div>
                    <div class="floating-emoji absolute text-3xl" style="top:-15%;right:-15%;animation-delay:0.5s;">✌️</div>
                    <div class="floating-emoji absolute text-3xl" style="bottom:5%;left:-10%;animation-delay:1s;">👍</div>
                    <div class="floating-emoji absolute text-3xl" style="bottom:5%;right:-10%;animation-delay:1.5s;">🖐️</div>
                    <img src="{{ asset('images/character.png') }}" alt="Karakter TUNAS" class="w-[200px] max-w-[90%] floating-emoji" style="animation-delay:0.2s;">
                </div>
            </div>

            {{-- Right: Registration Form --}}
            <div class="flex-1 w-full clay-card rounded-xl p-clay-padding animate-fade-right" style="animation-delay:0.15s;">
                <h2 class="font-bold text-2xl text-primary mb-1">Daftar Akun</h2>
                <p class="text-on-surface-variant font-body-md mb-6" id="roleSubtitle">Pilih peran Anda terlebih dahulu</p>

                @if ($errors->any())
                    <div class="w-full bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
                        <ul class="mb-0 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" id="roleInput" name="role" required>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Nama Depan --}}
                        <div>
                            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Nama Depan</label>
                            <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">badge</span>
                                <input name="nama_depan" type="text" value="{{ old('nama_depan') }}" required
                                    class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                    placeholder="Nama depan">
                            </div>
                        </div>
                        {{-- Nama Belakang --}}
                        <div>
                            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Nama Belakang</label>
                            <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">badge</span>
                                <input name="nama_belakang" type="text" value="{{ old('nama_belakang') }}" required
                                    class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                    placeholder="Nama belakang">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Email</label>
                        <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">mail</span>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    {{-- NIP / NIS / Kelas (conditional) --}}
                    <div class="mt-4" id="nip-group" style="display:none;">
                        <label class="font-label-md text-label-md text-primary ml-2 block mb-1">NIP (Nomor Induk Pegawai)</label>
                        <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">badge</span>
                            <input type="text" name="nip" value="{{ old('nip') }}"
                                class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                placeholder="Masukkan NIP">
                        </div>
                    </div>

                    <div class="mt-4" id="nis-group" style="display:none;">
                        <label class="font-label-md text-label-md text-primary ml-2 block mb-1">NIS (Nomor Induk Siswa)</label>
                        <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">school</span>
                            <input type="text" name="nis" value="{{ old('nis') }}"
                                class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                placeholder="Masukkan NIS">
                        </div>
                    </div>

                    <div class="mt-4" id="kelas-group" style="display:none;">
                        <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Kelas</label>
                        <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">group</span>
                            <select name="kelas" class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md">
                                <option value="">Pilih Kelas</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Password</label>
                            <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">lock</span>
                                <input type="password" name="password" required
                                    class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                    placeholder="Min. 8 karakter">
                            </div>
                        </div>
                        <div>
                            <label class="font-label-md text-label-md text-primary ml-2 block mb-1">Konfirmasi</label>
                            <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">lock</span>
                                <input type="password" name="password_confirmation" required
                                    class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                    placeholder="Ulangi password">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="font-label-md text-label-md text-primary ml-2 block mb-1">No. Telepon</label>
                        <div class="clay-input-container rounded-lg flex items-center px-4 py-3.5 group">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors mr-2">phone</span>
                            <input type="tel" name="telepon" value="{{ old('telepon') }}" required
                                class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body-md placeholder:text-outline/50"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" disabled
                        class="clay-button w-full py-4 rounded-lg text-white font-bold text-base mt-6 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">person_add</span> Daftar Sekarang
                    </button>

                    <p class="text-on-surface-variant font-body-md text-sm text-center mt-4">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-primary font-bold hover:underline transition-all">Login di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    {{-- Decorative Blobs --}}
    <div class="fixed top-[-15%] left-[-5%] w-[500px] h-[500px] bg-primary/5 rounded-full blur-[80px] -z-10"></div>
    <div class="fixed bottom-[-15%] right-[-5%] w-[500px] h-[500px] bg-secondary-container/10 rounded-full blur-[60px] -z-10"></div>

    <script>
        let selectedRole = '';

        function selectRole(role) {
            selectedRole = role;
            document.getElementById('roleInput').value = role;

            const guru = document.getElementById('guruCard');
            const siswa = document.getElementById('siswaCard');
            guru.style.border = '3px solid transparent';
            siswa.style.border = '3px solid transparent';

            const active = document.getElementById(role + 'Card');
            active.style.border = role === 'guru' ? '3px solid #4156ab' : '3px solid #fe8e2e';

            document.getElementById('roleSubtitle').textContent =
                role === 'guru' ? 'Daftar sebagai Guru' : 'Daftar sebagai Siswa';

            document.getElementById('nip-group').style.display = role === 'guru' ? 'block' : 'none';
            document.getElementById('nis-group').style.display = role === 'siswa' ? 'block' : 'none';
            document.getElementById('kelas-group').style.display = role === 'siswa' ? 'block' : 'none';

            document.getElementById('submitBtn').disabled = false;
        }
    </script>
</body>
</html>
